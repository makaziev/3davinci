<?php

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


class UserCommand extends Command
{
    private UserService $userService;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $this->userService = new UserService();
    }

    protected function configure()
    {
        $this->setName('app:run')
            ->addArgument('url', InputArgument::OPTIONAL, 'Pass the url');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new Question('Введите url [<comment>https://api.github.com/users</comment>]: ', 'https://api.github.com/users');
        $url = $helper->ask($input, $output, $question);

        $this->userService->run($url);
        $output->writeln('<info>Done</info>');
        return Command::SUCCESS;
    }
}
