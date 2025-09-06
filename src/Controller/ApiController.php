<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
    #[Route('/api/profile', name: 'api_profile', methods: ['GET'])]
public function profile(): JsonResponse
{
    // getUser() renvoie l'utilisateur actuellement authentifié grâce au token
    $user = $this->getUser();

    if (!$user) {
        return new JsonResponse(['error' => 'User not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
    }

    return new JsonResponse([
        'email' => $user->getUserIdentifier(),
        'roles' => $user->getRoles()
    ]);
}

}
