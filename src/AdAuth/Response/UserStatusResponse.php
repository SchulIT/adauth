<?php

namespace AdAuth\Response;

class UserStatusResponse extends AbstractResponse {

    use UserResponseTrait;

    public function __construct(private readonly bool $isActive, string $username, string $userPricipalName, ?string $firstname,
                                ?string $lastname, ?string $fullname, string $displayName, ?string $email,
                                string $guid, string $ou, array $groups) {
        $this->username = $username;
        $this->userPrincipalName = $userPricipalName;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->fullname = $fullname;
        $this->displayName = $displayName;
        $this->email = $email;
        $this->guid = $guid;
        $this->ou = $ou;
        $this->groups = $groups;
    }

    public function isActive(): bool {
        return $this->isActive;
    }

    /**
     * @internal
     */
    public static function fromJson(array $json): UserStatusResponse {
        return new UserStatusResponse(
            $json['is_active'],
            $json['username'],
            $json['upn'],
            $json['firstname'] ?? null,
            $json['lastname'] ?? null,
            $json['fullname'] ?? null,
            $json['display_name'],
            $json['email'] ?? null,
            $json['guid'],
            $json['ou'],
            $json['groups'] ?? [ ]
        );
    }
}