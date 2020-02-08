<?php

namespace AdAuth\Request;

use JMS\Serializer\Annotation as Serializer;

class StatusRequest extends AbstractRequest {
    private const RequestName = 'status';

    /**
     * @Serializer\SerializedName("users")
     * @Serializer\Type("array<string>")
     * @var string[]
     */
    private $users = [ ];

    /**
     * @param string[] $users
     */
    public function __construct(array $users) {
        parent::__construct(static::RequestName);

        $this->users = $users;
    }

    public function getUsers(): array {
        return $this->users;
    }
}