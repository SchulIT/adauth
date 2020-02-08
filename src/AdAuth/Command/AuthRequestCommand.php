<?php

namespace AdAuth\Command;

use AdAuth\AdAuth;
use AdAuth\Credentials;
use AdAuth\SocketException;
use AdAuth\Stream\TlsStream;
use AdAuth\Stream\UnencryptedStream;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class AuthRequestCommand extends BaseCommand {
    protected function configure() {
        $this
            ->setName('adauth:request:auth')
            ->setDescription('Send an authentication request to the server')
            ->addOption('host', null, InputOption::VALUE_REQUIRED, 'Server host')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'Server port', AdAuth::DefaultPort)
            ->addOption('peer_name', null, InputOption::VALUE_REQUIRED, 'Peer name')
            ->addOption('peer_fingerprint', null, InputOption::VALUE_REQUIRED, 'Peer fingerprint')
            ->addOption('ca_file', null, InputOption::VALUE_OPTIONAL, 'Path to CA file');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $host = $input->getOption('host');
        $port = $input->getOption('port') ?? AdAuth::DefaultPort;
        $peerName = $input->getOption('peer_name');
        $peerFingerprint = $input->getOption('peer_fingerprint');
        $caFile = $input->getOption('ca_file');

        if($host === null) {
            throw new \InvalidArgumentException('Option "host" is missing');
        }

        if($peerName === null) {
            throw new \InvalidArgumentException('Option "peer_name" is missing');
        }

        if($peerFingerprint === null) {
            throw new \InvalidArgumentException('Option "peer_fingerprint" is missing');
        }

        $stream = new TlsStream($caFile, $peerName, $peerFingerprint);

        $serializer = $this->getSerializer();
        $adAuth = new AdAuth($host, $stream, $serializer, $port);

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $question = new Question('Username: ');
        $username = $helper->ask($input, $output, $question);

        $question = new Question('Password: ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $question);

        try {
            $result = $adAuth->authenticate(new Credentials($username, $password));
            $json = $serializer->serialize($result, 'json', null);

            $output->writeln($json);
        } catch (SocketException $exception) {
            $this->getApplication()->renderThrowable($exception, $output);
        }
    }
}