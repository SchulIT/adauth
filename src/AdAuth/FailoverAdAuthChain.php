<?php

namespace AdAuth;

use AdAuth\Response\AbstractResponse;
use AdAuth\Response\AuthenticationResponse;
use AdAuth\Response\PasswordResponse;
use AdAuth\Response\PingResponse;
use AdAuth\Response\StatusResponse;
use Closure;
use Throwable;

/**
 * Tries to send requests to consecutive servers if one server fails. Supposed to be used to enable failover scenarios.
 */
class FailoverAdAuthChain implements AdAuthInterface{

    /** @var AdAuthInterface[] */
    private array $chain = [ ];

    /**
     * @param AdAuthInterface[] $chain
     */
    public function __construct(array $chain = []) {
        foreach($chain as $adAuth){
            $this->addToChain($adAuth);
        }
    }

    private function addToChain(AdAuthInterface $auth): void {
        $this->chain[] = $auth;
    }

    /**
     * @template T of AbstractResponse
     * @param Closure<T>(AdAuthInterface):T $commandToExecute
     * @return T
     * @throws Throwable
     */
    private function executeCommandInChain(Closure $commandToExecute): AbstractResponse {
        $lastException = null;

        foreach($this->chain as $adAuth){
            try {
                return $commandToExecute($adAuth);
            } catch(Throwable $exception) {
                $lastException = $exception;
            }
        }

        throw $lastException;
    }

    /**
     * @throws Throwable
     */
    public function ping(): PingResponse {
        return $this->executeCommandInChain(fn(AdAuthInterface $adAuth): PingResponse => $adAuth->ping());
    }

    /**
     * @throws Throwable
     */
    public function authenticate(Credentials $credentials): AuthenticationResponse {
        return $this->executeCommandInChain(fn(AdAuthInterface $adAuth): AuthenticationResponse => $adAuth->authenticate($credentials));
    }

    /**
     * @throws Throwable
     */
    public function changePassword(Credentials $oldCredentials, Credentials $newCredentials): PasswordResponse {
        return $this->executeCommandInChain(fn(AdAuthInterface $adAuth): PasswordResponse => $adAuth->changePassword($oldCredentials, $newCredentials));
    }

    /**
     * @throws Throwable
     */
    public function resetPassword(Credentials $newCredentials, Credentials $adminCredentials): PasswordResponse {
        return $this->executeCommandInChain(fn(AdAuthInterface $adAuth): PasswordResponse => $adAuth->resetPassword($newCredentials, $adminCredentials));
    }

    /**
     * @throws Throwable
     */
    public function status(array $users): StatusResponse {
        return $this->executeCommandInChain(fn(AdAuthInterface $adAuth): StatusResponse => $adAuth->status($users));
    }
}