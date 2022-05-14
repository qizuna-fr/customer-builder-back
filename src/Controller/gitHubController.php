<?php

namespace App\Controller;

use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitHubServiceInterface;
use App\Services\GitHubService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class gitHubController extends AbstractController
{
    public function __construct(private GitHubServiceInterface $github, private FormattingTextInterface $formattingText)
    {
    }
    
    #[Route('/formatted/city-name')]
    public function indexcreateCityName(): Response
    {
        $this->github->connectToGithub();
        $datas = $this->github->fetchDataFromDataBase();
        $cityName = $datas['cityName'];
        $formattedCityName = $this->formattingText->deleteSpace($cityName);
        $this->github->createBranchGithub($formattedCityName);
        $this->github->disconnectFromGithub();
        return new Response(null, 200);
    }

    #[Route('/set-title-style')]
    public function indexDefineTitleStyle(): Response
    {
        $this->github->connectToGithub();
        $datas = $this->github->fetchDataFromDataBase();


        return new Response(null, 200);
    }

    #[Route('/set-paragraph-style')]
    public function indexDefineParagraphStyle(): Response
    {
        $this->github->connectToGithub();
        $datas = $this->github->fetchDataFromDataBase();


        return new Response(null, 200);
    }

}
