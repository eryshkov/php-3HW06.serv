<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PutUserToQueueController extends AbstractController
{
    /**
     * @Route("/queue/put/user/", name="app_put_user_to_queue", methods={"POST"})
     */
    public function index(Request $request)
    {
        $data = $request->getContent();
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'received' => $data,
        ]);
    }
}
