<?php
namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Serializer\SerializerInterface;

class UserCommand extends Command
{
    protected static $defaultName = 'app:user-info';
    private UserRepository $userRepository;
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer, UserRepository $userRepository)
    {
        $this->serializer = $serializer;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Information Of User!')
            ->addArgument('userId', InputArgument::REQUIRED, 'ID of user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->userRepository->find($input->getArgument('userId'));
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Start show information of user:',
            '===========================',
            '',
        ]);

        $output->writeln('Hello '.$user->getName(). '!');
        $output->writeln('Your username is '.$user->getEmail(). '.');
        $output->writeln('Your account is ' . (($user->getName()) ? 'Activate' : 'Deactivate') .'.');
        $output->writeln([
            '',
            '===========================',
            'End show information of user.',
        ]);

        return Command::SUCCESS;
    }
}
