<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation as Serializer;

class StatusResponse extends AbstractResponse {
    /**
     * @Serializer\SerializedName("status")
     * @Serializer\Type("array<UserStatus>")
     */
    private $status;

    /**
     * @return UserStatus[]
     */
    public function getStatus() {
        return $this->status;
    }
}