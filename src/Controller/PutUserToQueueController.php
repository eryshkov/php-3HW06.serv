<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PutUserToQueueController extends AbstractController
{
    /**
     * @Route("/queue/put/user/", name="app_put_user_to_queue", methods={"POST"})
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());
    
//        'user_id' => $user->getId(),
//            'template_name' => 'test_template',
//            'template_params' => [
//        'from' => 'admin',
//        'message' => 'Hello, ',
//    ],
    
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'received' => $data,
        ], JsonResponse::HTTP_OK);
    }
}
