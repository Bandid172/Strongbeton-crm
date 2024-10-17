<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AuthController extends AbstractController
{
    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(): Response
    {
        return $this->render('admin/index.html.twig', [
            'variable' => 'Hello, World!',
        ]);
    }

    #[Route('/rand', name: 'app_rand', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function rand(): Response
    {
        return new Response('Hello', 201);
    }
}