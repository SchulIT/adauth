<?php

namespace AdAuth\Response;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

abstract class AbstractResponse {
    /**
     * @SerializedName("success")
     * @Type("boolean")
     */
    private $isSuccess;

    public function isSuccess() {
        return $this->isSuccess;
    }
}