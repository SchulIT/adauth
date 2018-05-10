<?php

namespace AdAuth\Stream;

use AdAuth\SocketConnectException;

class UnencryptedStream implements StreamInterface {

    /**
     * @inheritDoc
     */
    public function getStream($host, $port) {
        $stream = @stream_socket_client('tcp://' . $host . ':' . $port, $errno, $errstr, 1, STREAM_CLIENT_CONNECT);

        if(!is_resource($stream)) {
            throw new SocketConnectException('Fehler beim Verbinden: ' . $errstr);
        }

        return $stream;
    }
}