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
     */
    public function index(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        /** @var array $data */
        $data = json_decode($request->getContent(), true);
        
        $user = $userRepository->findOneBy([
            'id' => $data['user_id'],
        ]);
        
        if (!isset($user)) {
            throw new \LogicException('User with ID=' . $data['user_id'] . ' not found');
        }
        
        $task = new Task();
        $task->setUser($user);
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
