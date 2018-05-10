<?php

namespace AdAuth\Console;

class Application extends \Symfony\Component\Console\Application {
    public function __construct() {
        parent::__construct('AD Auth CLI');

        $this->setCatchExceptions(true);
    }
}