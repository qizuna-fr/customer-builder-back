<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiDispatcherController extends AbstractController
{
    #[Route('/api/dispatcher', name: 'app_api_dispatcher')]
    public function index(): Response
    {
        return $this->render('api_dispatcher/index.html.twig', [
            'controller_name' => 'ApiDispatcherController',
        ]);
    }
}
