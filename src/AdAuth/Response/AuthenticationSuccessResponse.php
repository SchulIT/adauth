<?php

namespace AdAuth\Response;

class AuthenticationSuccessResponse extends AuthenticationResponse {

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
}