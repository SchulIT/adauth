<?php

namespace AdAuth\Request;

use JsonSerializable;

abstract class AbstractRequest implements JsonSerializable {

    public function __construct(private readonly string $action) { }

    public function getAction(): string {
        return $this->action;
    }

    public function jsonSerialize(): array {
        return [
            'action' => $this->getAction()
        ];
    }
}