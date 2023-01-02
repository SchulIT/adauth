<?php

namespace AdAuth\Response;

abstract class AuthenticationResponse extends AbstractResponse {

    /**
     * @internal
     */
    public static function fromJson(array $json): AuthenticationResponse {
        if($json['success'] === false) {
            return new AuthenticationFailedResponse();
        }

        return new AuthenticationSuccessResponse(
            $json['username'],
            $json['upn'],
            $json['firstname'] ?? null,
            $json['lastname'] ?? null,
            $json['fullname'] ?? null,
            $json['display_name'],
            $json['email'] ?? null,
            $json['guid'],
            $json['ou'],
            $json['groups'] ?? [ ]
        );
    }
}