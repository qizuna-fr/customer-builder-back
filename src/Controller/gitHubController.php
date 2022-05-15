<?php

namespace App\Controller;

use App\Interfaces\ClientInterface;
use App\Interfaces\DataBaseManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitHubServiceInterface;
use App\Interfaces\TextCSSManagementInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class gitHubController extends AbstractController
{
    private $githubClient = [];
    public function __construct(private ClientInterface $client, private GitHubServiceInterface $github, private FormattingTextInterface $formattingText, private TextCSSManagementInterface $textCSSManagement, private DataBaseManagementInterface $dataBase)
    {
        $this->githubClient = $client->getGithubClient();
    }
    
    #[Route('/format-city-name')]
    public function formatCityName(): Response
    {
        $this->github->connectToGithub();
        $formattedCityName = $this->formattingText->deleteSpace($this->githubClient["cityName"]);
        $content = $this->github->addContent($formattedCityName);
        $repository = $this->github->fetchRepository($this->githubClient["cityName"]);
        if ($repository == "") $repository = $this->githubClient["cityName"]."-repository";
        $branchName = "formatted-cityName";
        $message = "formatting city name for ".$this->githubClient["cityName"];
        
        $this->github->updateRepository($this->githubClient["cityName"], $repository, $branchName, $content, $message);
        
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
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->githubClient["cityName"];

        $this->github->updateRepository($this->githubClient["cityName"], $branchName, $content, $message);

        $textStyle = $text.'Style';
        $style = $datas[$textStyle];
        $newStyle = $this->textCSSManagement->editTextStyle($style);
        $content = $this->github->addContent($newStyle);
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->githubClient["cityName"];

        $this->github->updateRepository($this->githubClient["cityName"], $branchName, $content, $message);

        $textColor = $text.'Color';
        $color = $datas[$textColor];
        $newColor = $this->textCSSManagement->editTextColor($color);
        $content = $this->github->addContent($newColor);
        $branchName = "edit-font-".$text;
        $message = "editing ".$text." font for ".$this->githubClient["cityName"];

        $this->github->updateRepository($this->githubClient["cityName"], $branchName, $content, $message);

        $this->github->disconnectFromGithub();
        return new Response('Editing '.$text.' style controller', 200);
    }



}
