<?php

namespace AdAuth\Response;

class StatusResponse extends AbstractResponse {

    /**
     * @param bool $isSuccess
     * @param UserStatusResponse[] $users
     */
    public function __construct(bool $isSuccess, private readonly array $users) {
        parent::__construct($isSuccess);
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
            $json['is_success'],
            $users
        );
    }
}