<?php

namespace AdAuth\Request;

use JMS\Serializer\Annotation as Serializer;

abstract class AbstractRequest {

    /**
     * @Serializer\SerializedName("action")
     * #@Serializer\Accessor(getter="getAction")
     * @Serializer\ReadOnly()
     * @var string
     */
    private $action;

    public function __construct(string $action) {
        $this->action = $action;
    }

    public function getAction(): string {
        return $this->action;
    }
}