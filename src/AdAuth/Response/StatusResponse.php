<?php

namespace AdAuth\Response;

class StatusResponse extends AbstractResponse {

    /**
     * @param UserStatusResponse[] $users
     */
    public function __construct(private readonly array $users) {
    }

    /**
     * @return UserStatusResponse[]
     */
    public function getUsers(): array {
        return $this->users;
    }

    /**
     * @internal
     */
    public static function fromJson(array $json): StatusResponse {
        $users = [ ];

        foreach($json['users'] as $user) {
            $users[] = UserStatusResponse::fromJson($user);
        }

        return new StatusResponse(
            $users
        );
    }
}