<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class AuthenticationResponse extends AbstractResponse {
    /**
     * @Serializer\SerializedName("username")
     * @Serializer\Type("string")
     */
    private $username;

    /**
     * @Serializer\SerializedName("firstname")
     * @Serializer\Type("string")
     */
    private $firstname;

    /**
     * @Serializer\SerializedName("lastname")
     * @Serializer\Type("string")
     */
    private $lastname;

    /**
     * @Serializer\SerializedName("fullname")
     * @Serializer\Type("string")
     */
    private $fullname;

    /**
     * @Serializer\SerializedName("employeeId")
     * @Serializer\Type("string")
     */
    private $emplyeeId;

    /**
     * @Serializer\SerializedName("OU")
     * @Serializer\Type("string")
     */
    private $ou;

    /**
     * @Serializer\SerializedName("groups")
     * @Serializer\Type("array<string>")
     */
    private $groups;

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getFullname() {
        return $this->fullname;
    }

    /**
     * @return string
     */
    public function getEmplyeeId() {
        return $this->emplyeeId;
    }

    /**
     * @return string
     */
    public function getOu() {
        return $this->ou;
    }

    /**
     * @return string[]
     */
    public function getGroups() {
        return $this->groups;
    }
}