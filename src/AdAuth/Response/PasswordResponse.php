<?php

namespace AdAuth\Response;

use JsonSerializable;

abstract class PasswordResponse implements JsonSerializable {
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


    public function jsonSerialize(): array {
        return [
            'result' => $this->result
        ];
    }
}