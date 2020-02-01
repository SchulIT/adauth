<?php

namespace AdAuth\Request;

use JMS\Serializer\Annotation as Serializer;

class AuthenticateRequest extends AbstractRequest {
    private const RequestName = 'auth';

    /**
     * @Serializer\SerializedName("username")
     * @Serializer\Accessor(getter="getUsername")
     * @Serializer\ReadOnly()
     * @var string
     */
    private $username;

    /**
     * @Serializer\SerializedName("password")
     * @Serializer\Accessor(getter="getPassword")
     * @Serializer\ReadOnly()
     * @var string
     */
    private $password;

    public function __construct(string $username, string $password) {
        parent::__construct(static::RequestName);

        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }
}