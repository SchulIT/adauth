<?php

namespace AdAuth;

interface AdAuthInterface {
    public function ping();

    public function authenticate(Credentials $credentials);

    public function status(array $usernames);
}