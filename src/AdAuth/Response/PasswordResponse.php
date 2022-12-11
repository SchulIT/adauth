<?php

namespace AdAuth\Response;

abstract class PasswordResponse {
    public function __construct(private readonly ?string $result) { }

    public function getResult(): ?string {
        return $this->result;
    }

    public static function fromJson(array $json): PasswordResponse {
        if($json['success'] === false) {
            return new PasswordFailedResponse($json['result']);
        }

        return new PasswordSuccessResponse($json['result']);
    }
}