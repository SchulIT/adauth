<?php

namespace AdAuth\Request;

use JMS\Serializer\Annotation as Serializer;

class StatusRequest extends AbstractRequest {

    /**
     * @Serializer\SerializedName("usernames")
     * @Serializer\Accessor(getter="getUsernames")
     * @Serializer\ReadOnly()
     * @var string[]
     */
    private $usernames;

    /**
     * @param string[] $usernames
     */
    public function __construct(array $usernames) {
        parent::__construct('status');

        $this->usernames = $usernames;
    }

    /**
     * @return string[]
     */
    public function getUsernames(): array {
        return $this->usernames;
    }
}