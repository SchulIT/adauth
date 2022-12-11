<?php

namespace AdAuth\Response;

class PasswordFailedResponse extends PasswordResponse {
    public function __construct(?string $result) {
        parent::__construct($result);
    }
}