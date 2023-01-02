<?php

namespace AdAuth\Response;

use JsonSerializable;

class AuthenticationSuccessResponse extends AuthenticationResponse implements JsonSerializable {

    use UserResponseTrait;

    public function __construct(string $username, string $userPricipalName, ?string $firstname,
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

    public function jsonSerialize(): array {
        return [
            'username' => $this->username,
            'user_principal_name' => $this->userPrincipalName,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'display_name' => $this->displayName,
            'email' => $this->email,
            'guid' => $this->guid,
            'ou' => $this->ou,
            'groups' => $this->groups
        ];
    }
}