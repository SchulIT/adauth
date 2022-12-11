<?php

namespace AdAuth\Request;

use JsonSerializable;

abstract class AbstractPasswordRequest extends AbstractRequest implements JsonSerializable {
    public function __construct(private readonly string $username, private readonly string $newPassword, string $action) {
        parent::__construct($action);
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [
                'username' => $this->username,
                'new_password' => $this->newPassword
            ]
        );
    }
}