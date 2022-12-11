<?php

namespace AdAuth\Request;

use JsonSerializable;

class ResetPasswordRequest extends AbstractPasswordRequest implements JsonSerializable {

    private const RequestName = 'reset_password';

    public function __construct(string $username, string $newPassword, private readonly string $adminUsername, private readonly string $adminPassword) {
        parent::__construct($username, $newPassword, static::RequestName);
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [
                'admin_username' => $this->adminUsername,
                'admin_password' => $this->adminPassword
            ]
        );
    }
}