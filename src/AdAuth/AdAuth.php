<?php

namespace AdAuth;

use AdAuth\Request\AbstractRequest;
use AdAuth\Request\AuthenticateRequest;
use AdAuth\Request\PingRequest;
use AdAuth\Response\AbstractResponse;
use AdAuth\Response\AuthenticationResponse;
use AdAuth\Response\PingResponse;
use AdAuth\Stream\StreamInterface;
use JMS\Serializer\SerializerInterface;

class AdAuth implements AdAuthInterface {
    const DefaultPort = 55117;

    private $host = '';
    private $port = null;

    private $stream;
    private $serializer;

    public function __construct($host, StreamInterface $stream, SerializerInterface $serializer, $port = self::DefaultPort) {
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
     * @return AuthenticationResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function authenticate(Credentials $credentials): AbstractResponse {
        return $this->request(new AuthenticateRequest($credentials->getUsername(), $credentials->getPassword()), AuthenticationResponse::class);
    }

    /**
     * @return PingResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    public function ping(): AbstractResponse {
        return $this->request(new PingRequest(), PingResponse::class);
    }

    /**
     * @param AbstractRequest $request
     * @param $resultType
     * @return AbstractResponse
     * @throws SocketReadException
     * @throws SocketWriteException
     * @throws SocketConnectException
     */
    private function request(AbstractRequest $request, $resultType) {
        $json = $this->serializer
            ->serialize($request, 'json');

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
            throw new SocketReadException();
        }

        return $result;
    }
}