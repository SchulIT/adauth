<?php

namespace AdAuth\Stream;

use AdAuth\SocketConnectException;

interface StreamInterface {
    /**
     * @throws SocketConnectException
     * @return resource
     */
    public function getStream($host, $port);
}