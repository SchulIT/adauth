<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class UserStatusResponse extends AbstractResponse {

    use UserResponseTrait;

    /**
     * @Serializer\SerializedName("is_active")
     * @Serializer\Type("boolean")
     * @var bool
     */
    private $isActive;

    public function isActive(): bool {
        return $this->isActive;
    }
}