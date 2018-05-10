<?php

use AdAuth\Command\AuthRequestCommand;
use AdAuth\Command\PingRequestCommand;
use AdAuth\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

set_time_limit(0);

$application = new Application();
$application->add(new AuthRequestCommand());
$application->add(new PingRequestCommand());
$application->run();