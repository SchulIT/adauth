<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class StatusResponse extends AbstractResponse {

    /**
     * @Serializer\Type("array<string, AdAuth\Response\UserStatusResponse>")
     * @var UserStatusResponse[]
     */
    private $users;

    /**
     * @return UserStatusResponse[]
     */
    public function getUsers(): array {
        return $this->users;
    }
}