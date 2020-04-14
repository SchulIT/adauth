<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

trait UserResponseTrait {
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
     * @Serializer\SerializedName("display_name")
     * @Serializer\Type("string")
     */
    private $displayName;

    /**
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @Serializer\SerializedName("guid")
     * @Serializer\Type("string")
     */
    private $guid;

    /**
     * @Serializer\SerializedName("unique_id")
     * @Serializer\Type("string")
     */
    private $uniqueId;

    /**
     * @Serializer\SerializedName("ou")
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
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstname(): string {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getFullname(): string {
        return $this->fullname;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string {
        return $this->displayName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getGuid(): string {
        return $this->guid;
    }

    /**
     * @return string|null
     */
    public function getUniqueId(): ?string {
        return $this->uniqueId;
    }

    /**
     * @return string
     */
    public function getOu(): string {
        return $this->ou;
    }

    /**
     * @return string[]
     */
    public function getGroups(): array {
        return $this->groups;
    }
}