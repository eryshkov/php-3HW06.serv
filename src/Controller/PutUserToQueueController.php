<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PutUserToQueueController extends AbstractController
{
    /**
     * @Route("/queue/put/user/", name="app_put_user_to_queue", methods={"POST"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PutUserToQueueController.php',
        ]);
    }
}
