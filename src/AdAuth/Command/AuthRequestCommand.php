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

class AuthRequestCommand extends BaseCommand {
    protected function configure() {
        $this
            ->setName('adauth:request:auth')
            ->setDescription('Send an authentication request to the server')
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

        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $question = new Question('Username: ');
        $username = $helper->ask($input, $output, $question);

        $question = new Question('Password: ');
        $question->setHidden(true);
        $question->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $question);

        $question = new ConfirmationQuestion('Use secondary account information? (y/n) ', false);
        $useSecondaryAccountInfo = $helper->ask($input, $output, $question);

        $result = $adAuth->authenticate(new Credentials($username, $password), $useSecondaryAccountInfo);
        $json = $serializer->serialize($result, 'json', null);

        $output->writeln($json);
    }
}