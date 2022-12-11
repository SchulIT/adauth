<?php

namespace AdAuth\Response;

class PingResponse extends AbstractResponse {
    public function __construct() {
        parent::__construct(true);
    }
}