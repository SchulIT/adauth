<?php

namespace AdAuth;

use AdAuth\Request\AbstractRequest;
use AdAuth\Request\AuthenticateRequest;
use AdAuth\Request\ChangePasswordRequest;
use AdAuth\Request\PingRequest;
use AdAuth\Request\ResetPasswordRequest;
use AdAuth\Request\StatusRequest;
use AdAuth\Response\AuthenticationResponse;
use AdAuth\Response\AuthenticationSuccessResponse;
use AdAuth\Response\PasswordResponse;
use AdAuth\Response\PingResponse;
use AdAuth\Response\StatusResponse;
use AdAuth\Stream\StreamInterface;

class AdAuth implements AdAuthInterface {
    const DefaultPort = 55117;

    public function __construct(private readonly string $host, private readonly StreamInterface $stream, private readonly int $port = self::DefaultPort) {

    }

    public function getHost(): string {
        return $this->host;
    }

    public function getPort(): int {
        return $this->port;
    }

    public function authenticate(Credentials $credentials): AuthenticationResponse {
        $response = $this->request(new AuthenticateRequest($credentials->getUsername(), $credentials->getPassword()), AuthenticationSuccessResponse::class);
        return AuthenticationResponse::fromJson($response);
    }

    public function changePassword(Credentials $oldCredentials, Credentials $newCredentials): PasswordResponse {
        $response = $this->request(new ChangePasswordRequest($oldCredentials->getUsername(), $oldCredentials->getPassword(), $newCredentials->getPassword()));
        return PasswordResponse::fromJson($response);
    }

    public function resetPassword(Credentials $newCredentials, Credentials $adminCredentials): PasswordResponse {
        $response = $this->request(new ResetPasswordRequest($newCredentials->getUsername(), $newCredentials->getPassword(), $adminCredentials->getUsername(), $adminCredentials->getPassword()));
        return PasswordResponse::fromJson($response);
    }

    public function ping(): PingResponse {
        $response = $this->request(new PingRequest());
        return new PingResponse();
    }

    public function status(array $users): StatusResponse {
        $response = $this->request(new StatusRequest($users));
        return StatusResponse::fromJson($response);
    }

    /**
     * @param AbstractRequest $request
     * @return array The JSON response parsed as array
     * @throws SocketConnectException
     * @throws SocketReadException
     * @throws SocketWriteException
     */
    private function request(AbstractRequest $request): array {
        $json = json_encode($request);

        $stream = $this->stream->getStream($this->getHost(), $this->getPort());

        $write = @fwrite($stream, $json);
        $flush = @fflush($stream);

        if($write === false || $flush === false) {
            throw new SocketWriteException();
        }

        $response = '';

        while(!feof($stream)) {
            $response .= fgets($stream);
        }

        $result = json_decode($response, true);

        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new SocketReadException();
        }

        return $result;
    }
}