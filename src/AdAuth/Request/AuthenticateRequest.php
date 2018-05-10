<?php

namespace AdAuth\Request;

class AuthenticateRequest extends AbstractRequest {
    private $username;
    private $password;

    public function __construct($username, $password) {
        parent::__construct('auth');

        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() {
        return [
            'action' => $this->getAction(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ];
    }
}