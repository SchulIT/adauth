<?php

namespace AdAuth\Stream;

interface StreamInterface {
    /**
     * @return resource
     */
    public function getStream($host, $port);
}