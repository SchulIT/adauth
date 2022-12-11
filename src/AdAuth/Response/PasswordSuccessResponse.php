<?php

namespace AdAuth\Response;

class PasswordSuccessResponse extends PasswordResponse {
    public function __construct(?string $result) {
        parent::__construct($result);
    }
}