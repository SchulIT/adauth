<?php

namespace AdAuth;

use AdAuth\Stream\StreamInterface;
use JMS\Serializer\Serializer;
use AdAuth\Request\AbstractRequest;
use AdAuth\Request\AuthenticateRequest;
use AdAuth\Request\PingRequest;
use AdAuth\Request\StatusRequest;
use AdAuth\Response\AbstractResponse;
use AdAuth\Response\AuthenticationResponse;
use AdAuth\Response\PingResponse;
use AdAuth\Response\StatusResponse;

class AdAuth implements AdAuthInterface {
    const DefaultPort = 55117;

    private $host = '';
    private $port = null;

    private $stream;
    private $serializer;

    public function __construct($host, $port = self::DefaultPort, StreamInterface $stream, Serializer $serializer) {
        $this->host = $host;
        $this->port = $port;

        $this->stream = $stream;
        $this->serializer = $serializer;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    /**
     * @param Credentials $credentials
     * @param bool $useSecondaryAccountInfo
     * @return AuthenticationResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     */
    public function authenticate(Credentials $credentials, $useSecondaryAccountInfo = false) {
        return $this->request(new AuthenticateRequest($credentials->getUsername(), $credentials->getPassword(), $useSecondaryAccountInfo), AuthenticationResponse::class);
    }

    /**
     * @param array $usernames
     * @return StatusResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     */
    public function status(array $usernames) {
        return $this->request(new StatusRequest($usernames), StatusResponse::class);
    }

    /**
     * @return PingResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     */
    public function ping() {
        return $this->request(new PingRequest(), PingResponse::class);
    }

    /**
     * @param AbstractRequest $request
     * @param $resultType
     * @return AbstractResponse
     * @throws SocketConnectException
     * @throws SocketReadException
     * @throws SocketWriteException
     */
    private function request(AbstractRequest $request, $resultType) {
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

        $result = $this->serializer
            ->deserialize($response, $resultType, 'json');

        if($result === null) {
            throw new SocketReadException(json_last_error_msg());
        }

        return $result;
    }
}