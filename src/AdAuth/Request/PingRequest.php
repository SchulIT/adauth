<?php

namespace AdAuth\Request;

use JsonSerializable;

class PingRequest extends AbstractRequest implements JsonSerializable {
    private const RequestName = 'ping';

    public function __construct() {
        parent::__construct(static::RequestName);
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [ ]
        );
    }
}