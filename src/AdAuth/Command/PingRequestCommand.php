<?php

namespace AdAuth\Command;

use AdAuth\AdAuth;
use AdAuth\Credentials;
use AdAuth\Stream\TlsStream;
use AdAuth\Stream\UnencryptedStream;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class PingRequestCommand extends BaseCommand {
    protected function configure() {
        $this
            ->setName('adauth:request:ping')
            ->setDescription('Send a ping request to the server')
            ->addOption('host', null, InputOption::VALUE_REQUIRED, 'Server host')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'Server port', AdAuth::DefaultPort)
            ->addOption('tls', null, InputOption::VALUE_OPTIONAL, 'Use TLS?');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $host = $input->getOption('host');
        $port = $input->getOption('port') ?? AdAuth::DefaultPort;

        if($host === null) {
            throw new \InvalidArgumentException('Option "host" is missing');
        }

        $useTls = $input->hasParameterOption('--tls');

        $stream = $useTls ? new TlsStream() : new UnencryptedStream();

        $serializer = $this->getSerializer();
        $adAuth = new AdAuth($host, $port, $stream, $serializer);

        $result = $adAuth->ping();
        $json = $serializer->serialize($result, 'json', null);

        $output->writeln($json);
    }
}