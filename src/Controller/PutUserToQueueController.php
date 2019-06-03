<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PutUserToQueueController extends AbstractController
{
    /**
     * @Route("/queue/put/user/", name="app_put_user_to_queue", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        /** @var array $data */
        $data = json_decode($request->getContent(), true);
        
        $task = new Task();
        $task->setUserId($data['user_id']);
        $task->setTemplateName($data['template_name']);
        $task->setTemplateParameters($data['template_params']);
        date_default_timezone_set('Europe/Moscow');
        $task->setCreationDate(new DateTime());
        
        $entityManager->persist($task);
        $entityManager->flush();
        
        return $this->json([
            'response' => 'Task accepted',
        ], JsonResponse::HTTP_OK);
    }
}
