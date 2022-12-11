<?php

namespace AdAuth\Request;

use JsonSerializable;

class AuthenticateRequest extends AbstractRequest implements JsonSerializable {
    private const RequestName = 'authenticate';

    public function __construct(private readonly string $username, private readonly string $password) {
        parent::__construct(static::RequestName);
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [
                'username' => $this->getUsername(),
                'password' => $this->getPassword()
            ]
        );
    }
}