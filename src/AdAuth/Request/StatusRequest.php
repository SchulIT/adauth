<?php

namespace AdAuth\Request;

use InvalidArgumentException;
use JsonSerializable;

class StatusRequest extends AbstractRequest implements JsonSerializable {
    private const RequestName = 'status';

    /**
     * @param string[] $users
     */
    public function __construct(private readonly array $users) {
        parent::__construct(static::RequestName);

        foreach($this->users as $user) {
            if(!is_string($user)) {
                throw new InvalidArgumentException(
                    sprintf('User "%s" is not of type string (%s given)', $user, gettype($user))
                );
            }
        }
    }

    public function getUsers(): array {
        return $this->users;
    }

    public function jsonSerialize(): array {
        return array_merge(
            parent::jsonSerialize(),
            [
                'users' => $this->getUsers()
            ]
        );
    }
}