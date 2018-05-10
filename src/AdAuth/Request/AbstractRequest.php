<?php

namespace AdAuth\Request;

abstract class AbstractRequest implements \JsonSerializable {
    private $action;

    public function __construct($action) {
        $this->action = $action;
    }

    public function getAction() {
        return $this->action;
    }
}