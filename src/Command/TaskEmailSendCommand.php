<?php

namespace App\Command;

use App\Repository\TaskRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;

class TaskEmailSendCommand extends Command
{
    public const PENDING = 'Pending';
    public const SENT = 'Sent';
    public const ERROR = 'Error';
    
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
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var HttpClientInterface
     */
    private $httpClient;
    /**
     * @var string
     */
    private $mainAppServiceURL;
    
    public function __construct(
        TaskRepository $taskRepository,
        Swift_Mailer $mailer,
        Environment $templating,
        EntityManagerInterface $entityManager,
        string $mainAppServiceURL,
        HttpClientInterface $httpClient,
        ?string $name = null
    )
    {
        parent::__construct($name);
        $this->taskRepository = $taskRepository;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->entityManager = $entityManager;
        $this->httpClient = $httpClient;
        $this->mainAppServiceURL = $mainAppServiceURL;
    }
    
    protected function configure()
    {
        $this
            ->setDescription('This task sends emails');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        $emailCount = 0;
        do {
            $currentTask = $this->taskRepository->getOneFirstUndone();
            
            if (!isset($currentTask)) {
                break;
            }
            
            $currentTask->setStatus('Pending');
            $this->entityManager->persist($currentTask);
            $this->entityManager->flush();
            
            $response = $this->httpClient->request(
                'GET',
                $this->mainAppServiceURL . $currentTask->getUserId());
            $userEmail = $response->toArray()['email'];
            
            $templateName = $currentTask->getTemplateName();
            $templateParameters = $currentTask->getTemplateParameters();
            
            $message = (new Swift_Message('Hello Email'))
                ->setFrom(['dwebbo@bk.ru' => 'INFO'])
                ->setTo($userEmail)
                ->setBody(
                    $this->templating->render(
                        'emails/' . $templateName,
                        $templateParameters
                    ),
                    'text/html'
                );
            
            $result = $this->mailer->send($message);
            
            if (0 !== $result) {
                $emailCount += $result;
                $currentTask->setCompletionDate(new DateTime());
                $currentTask->setStatus('Sent');
            } else {
                $currentTask->setCompletionDate(new DateTime());
                $currentTask->setStatus('Error');
            }
            
            $this->entityManager->persist($currentTask);
            $this->entityManager->flush();
        } while (true);
        
        
        if ($emailCount > 0) {
            $io->success($emailCount . ' emails were sent!');
        } else {
            $io->error('No emails were sent!');
        }
    }
}
