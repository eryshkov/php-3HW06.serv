<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetTaskStatusByIdController extends AbstractController
{
    /**
     * @Route("/get/task/status/{id}", name="app_get_task_status_by_id", methods={"GET"})
     */
    public function index(int $id, TaskRepository $taskRepository)
    {
        $task = $taskRepository->findOneBy([
            'id' => $id,
        ]);
    
        if (!isset($task)) {
            return $this->json(['task' => 'not found']);
        }
        
        return $this->json(['task_status' => $task->getStatus()]);
    }
}
