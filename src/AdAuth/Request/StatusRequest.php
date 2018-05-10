<?php

namespace AdAuth\Request;

class StatusRequest extends AbstractRequest {
    private $usernames;

    public function __construct(array $usernames) {
        parent::__construct('status');

        $this->usernames = $usernames;
    }

    public function getUsernames() {
        return $this->usernames;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize() {
        return [
            'action' => $this->getAction(),
            'usernames' => $this->getUsernames()
        ];
    }
}