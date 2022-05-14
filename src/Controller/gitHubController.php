<?php

namespace App\Controller;

use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitHubServiceInterface;
use App\Interfaces\TextCSSManagementInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class gitHubController extends AbstractController
{
    public function __construct(private GitHubServiceInterface $github, private FormattingTextInterface $formattingText, TextCSSManagementInterface $textCSSManagement)
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
        $titleFont = $datas['titleFont'];
        $new_title = $this->textCSSManagement->editTitleFont($titleFont);
        $this->github->createBranchGithub("title-font");
        $this->github->disconnectFromGithub();
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
