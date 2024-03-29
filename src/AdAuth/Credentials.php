<?php

namespace AdAuth;

class Credentials {
    public function __construct(private readonly string $username, private readonly string $password) { }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }
}