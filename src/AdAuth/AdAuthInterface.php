<?php

namespace AdAuth;

interface AdAuthInterface {
    public function ping();

    public function authenticate(Credentials $credentials, $useSecondaryAccountInfo = false);

    public function status(array $usernames);
}