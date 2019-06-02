<?php

namespace App\Command;

use App\Repository\TaskRepository;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Twig\Environment;

class TaskEmailSendCommand extends Command
{
    protected static $defaultName = 'app:task:email:send';
    /**
     * @var TaskRepository
     */
    private $taskRepository;
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $templating;
    
    public function __construct(?string $name = null, TaskRepository $taskRepository, Swift_Mailer $mailer, Environment $templating)
    {
        parent::__construct($name);
        $this->taskRepository = $taskRepository;
        $this->mailer = $mailer;
        $this->templating = $templating;
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
    
            $message = (new Swift_Message('Hello Email'))
                ->setFrom('dwebbo@bk.ru')
                ->setTo('eryshkov@gmail.com')
                ->setBody(
                    $this->templating->render(
                        'emails/test_template.html.twig',
                        ['name' => $name]
                    ),
                    'text/html'
                );
    
            $result = $this->mailer->send($message);
        } while (null !== $lastTask);
    
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
