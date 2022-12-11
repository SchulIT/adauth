<?php

namespace AdAuth\Response;

trait UserResponseTrait {

    private readonly string $username;
    private readonly string $userPrincipalName;
    private readonly ?string $firstname;
    private readonly ?string $lastname;
    private readonly ?string $fullname;
    private readonly string $displayName;
    private readonly ?string $email;
    private readonly string $guid;
    private readonly string $ou;
    private readonly array $groups;

    public function getUsername(): string {
        return $this->username;
    }

    public function getUserPrincipalName(): string {
        return $this->userPrincipalName;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getFullname(): string {
        return $this->fullname;
    }

    public function getDisplayName(): string {
        return $this->displayName;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getGuid(): string {
        return $this->guid;
    }

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