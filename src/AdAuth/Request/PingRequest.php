<?php

namespace AdAuth\Request;

class PingRequest extends AbstractRequest {
    public function __construct() {
        parent::__construct('ping');
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() {
        return [
            'action' => $this->getAction()
        ];
    }
}