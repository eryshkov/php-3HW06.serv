<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\UserRepository;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PutUserToQueueController extends AbstractController
{
    /**
     * @Route("/queue/put/user/", name="app_put_user_to_queue", methods={"POST"})
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        /** @var stdClass $data */
        $data = json_decode($request->getContent());
    
//        'user_id' => $user->getId(),
//            'template_name' => 'test_template',
//            'template_params' => [
//        'from' => 'admin',
//        'message' => 'Hello, ',
//    ],
    
        $user = $userRepository->findOneBy([
            'id' => $data->user_id,
        ]);
    
        if (!isset($user)) {
            throw new \LogicException('User with ID=' . $data->user_id . ' not found');
        }
    
        
        
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'received' => $data,
        ], JsonResponse::HTTP_OK);
    }
}
