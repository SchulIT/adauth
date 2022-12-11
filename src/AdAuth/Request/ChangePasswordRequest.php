<?php

namespace AdAuth\Request;

use JsonSerializable;

class ChangePasswordRequest extends AbstractPasswordRequest implements JsonSerializable {

    private const RequestName = 'change_password';

    public function __construct(string $username, private readonly string $oldPassword, string $newPassword) {
        parent::__construct($username, $newPassword, static::RequestName);
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [
                'old_password' => $this->oldPassword
            ]
        );
    }
}