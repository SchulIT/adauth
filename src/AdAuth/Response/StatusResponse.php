<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class StatusResponse extends AbstractResponse {
    /**
     * @Serializer\SerializedName("status")
     * @Serializer\Type("array<AdAuth\Response\UserStatus>")
     */
    private $status;

    /**
     * @return UserStatus[]
     */
    public function getStatus() {
        return $this->status;
    }
}