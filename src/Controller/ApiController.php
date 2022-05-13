<?php

namespace App\Controller;

use App\Service\GitHubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApiController extends AbstractController
{

    public function __construct(private GitHubService $github)
    {
        
    }
    #[Route('/')]
    public function index(): Response
    {
        return new Response("Hello Controller");
    }
}
