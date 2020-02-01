<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class UserStatus {

    /**
     * @Serializer\SerializedName("username")
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @Serializer\SerializedName("isUserActive")
     * @Serializer\Type("boolean")
     */
    private $isActive;

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }
}