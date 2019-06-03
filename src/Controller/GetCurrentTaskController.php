<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GetCurrentTaskController extends AbstractController
{
    /**
     * @Route("/get/task/current", name="app_get_task_current", methods={"GET"})
     */
    public function index(TaskRepository $taskRepository)
    {
        $currentTask =  $taskRepository->getCurrent();
    
        if (!isset($currentTask)) {
            return $this->json(['current_task_id' => 'none']);
        }
    
        return $this->json(['current_task_id' => $currentTask->getId()]);
    }
}
