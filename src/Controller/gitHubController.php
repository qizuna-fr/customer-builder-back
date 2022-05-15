<?php

namespace App\Controller;

use App\Interfaces\DataBaseManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitHubServiceInterface;
use App\Interfaces\TextCSSManagementInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class gitHubController extends AbstractController
{
    private string $clientCityName;
    public function __construct(private GitHubServiceInterface $github, private FormattingTextInterface $formattingText, private TextCSSManagementInterface $textCSSManagement, private DataBaseManagementInterface $dataBase)
    {
        $this->clientCityName = "cityName";
    }
    
    #[Route('/format-city-name')]
    public function formatCityName(): Response
    {
        $this->github->connectToGithub();
        $formattedCityName = $this->formattingText->deleteSpace($this->clientCityName);
        $content = $this->github->addContent($formattedCityName);
        $repositoryName = $this->github->fetchRepository($this->clientCityName);
        $branchName = "formatted-cityName";
        $message = "formatting city name for ".$this->clientCityName;
        
        $this->github->updateRepository($this->clientCityName, $repositoryName, $branchName, $content, $message);
        
        $this->github->disconnectFromGithub();
        return new Response("Formatting city name controller", 200);
    }

    #[Route('/edit/{text}/style-and-font')]
    public function defineTitleStyle($text): Response
    {
        $this->github->connectToGithub();
        $datas = $this->dataBase->fetchDataFromDataBase();

        $textFont = $text.'Font';
        $font = $datas[$textFont];
        $newFont = $this->textCSSManagement->editTextFont($font);
        $content = $this->github->addContent($newFont);
        $repositoryName = $this->github->fetchRepository($this->clientCityName);
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->clientCityName;

        $this->github->updateRepository($this->clientCityName, $repositoryName, $branchName, $content, $message);

        $textStyle = $text.'Style';
        $style = $datas[$textStyle];
        $newStyle = $this->textCSSManagement->editTextStyle($style);
        $content = $this->github->addContent($newStyle);
        $repositoryName = $this->github->fetchRepository($this->clientCityName);
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->clientCityName;

        $this->github->updateRepository($this->clientCityName, $repositoryName, $branchName, $content, $message);

        $textColor = $text.'Color';
        $color = $datas[$textColor];
        $newColor = $this->textCSSManagement->editTextColor($color);
        $content = $this->github->addContent($newColor);
        $repositoryName = $this->github->fetchRepository($this->clientCityName);
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->clientCityName;

        $this->github->updateRepository($this->clientCityName, $repositoryName, $branchName, $content, $message);

        $this->github->disconnectFromGithub();
        return new Response('Editing '.$text.' style controller', 200);
    }

}
