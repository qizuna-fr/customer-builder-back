<?php

namespace App\Controller;

use App\Services\GitHubService;
use GitHubServiceInterface;
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
        $this->github->connectToGithub();
        $this->github->createBranchGithub();
        $this->github->disconnectFromGithub();

        return new Response("Hello Controller ");
    }
}
