<?php

namespace AdAuth\Request;

class PingRequest extends AbstractRequest {
    private const RequestName = 'ping';

    public function __construct() {
        parent::__construct(static::RequestName);
    }
}