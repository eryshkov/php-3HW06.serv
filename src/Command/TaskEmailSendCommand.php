<?php

namespace App\Command;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TaskEmailSendCommand extends Command
{
    protected static $defaultName = 'app:task:email:send';
    /**
     * @var TaskRepository
     */
    private $taskRepository;
    
    public function __construct(?string $name = null, TaskRepository $taskRepository)
    {
        parent::__construct($name);
        $this->taskRepository = $taskRepository;
    }
    
    protected function configure()
    {
        $this
            ->setDescription('This task sends emails')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
    
        do {
            $lastTask = $this->taskRepository->getOneFirstUndone();
        } while (null !== $lastTask);
    
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
