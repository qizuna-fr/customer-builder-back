<?php

namespace App\Controller;

use App\Interfaces\ClientInterface;
use App\Interfaces\DataBaseManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitHubServiceInterface;
use App\Interfaces\HubspotServiceInterface;
use App\Interfaces\ImaginaryServiceInterface;
use App\Interfaces\TextCSSManagementInterface;
use App\Services\Dummy\DummyHubspotService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{

    private $data = [];
    public function __construct(private GitHubServiceInterface $github, private FormattingTextInterface $formattingText, 
    private TextCSSManagementInterface $textCSSManagement, private ImaginaryServiceInterface $imaginary, 
    private DataBaseManagementInterface $dataBase, private ClientInterface $client, private HubspotServiceInterface $hubspot)
    {
        $this->data = $this->dataBase->fetchDataFromDataBase($this->client->getClientName());

    }

    private function createFile($data){
        return new JsonResponse($data);
    }
    
    #[Route('/format-city-name')]
    public function formatCityName(): Response
    {
        $formattedCityName = $this->formattingText->deleteSpace($this->data["cityName"]);

        $branchName = "formatted-cityName";
        $message = "formatting city name for ".$this->data["cityName"];
        $file = $this->createFile(array('cityName' => $formattedCityName));
        $this->github->pushFileToGithub($file, $branchName, $message);
        
        return new Response("Formatting city name", 200);
    }

    #[Route('/edit-font/{text}/{font}')]
    public function defineFont($text, $font): Response
    {
        if (! in_array($text.'Font', $this->data)) throw new Exception($text."Font n'existe pas !");
        $textName = $this->data[$text.'Font'];
        $this->textCSSManagement->editTextFont($textName, $font);
        $file = $this->createFile(array($textName => $font));

        $branchName = "edit-font-".$textName;
        $message = "editing ".$textName." font for ".$this->data["cityName"];
        $this->github->pushFileToGithub($file, $branchName, $message);

        return new Response('Editing '.$text.' font to '.$font, 200);
    }

    #[Route('/edit-style/{text}/{style}')]
    public function defineStyle($text, $style): Response
    { 
        if (! in_array($text.'Style', $this->data)) throw new Exception($text."Style n'existe pas !");
        $textName = $this->data[$text.'Style'];
        $this->textCSSManagement->editTextStyle($textName, $style);
        $file = $this->createFile(array($textName => $style));

        $branchName = "edit-style-".$textName;
        $message = "editing ".$textName." style for ".$this->data["cityName"];
        $this->github->pushFileToGithub($file, $branchName, $message);

        return new Response('Editing '.$text.' style controller', 200);
    }
    
    #[Route('/edit-color/{text}/{style}')]
    public function defineColor($text, $color): Response
    {

        if (! in_array($text.'Color', $this->data)) throw new Exception($text."Color n'existe pas !");
        $textName = $this->data[$text.'Color'];
        $this->textCSSManagement->editTextColor($textName, $color);
        $file = $this->createFile(array($textName => $color));

        $branchName = "edit-color-".$textName;
        $message = "editing ".$textName." color for ".$this->data["cityName"];
        $this->github->pushFileToGithub($file, $branchName, $message);

        return new Response('Editing '.$text.' color controller', 200);
    }

    #[Route('/resize/{clientFile}/{width}/{hight}')]
    public function resizeImage($width, $hight, $clientFile): Response
    {
        $file = $this->data['clientFiles'][$clientFile];
        $this->imaginary->resizeImage($file, $width, $hight);

        $branchName = "resize-image";
        $message = "resizing image for ".$this->data["cityName"];
        $fileToPush = $this->createFile(array($clientFile => array('width' => $width, 'hight' => $hight)));

        $this->github->pushFileToGithub($fileToPush, $branchName, $message);
        
        return new Response('resizing image '.$clientFile, 200);
    }

    #[Route('/create-client-hubspot/{clientName}/{clientMail}')]
    public function createHubspotClient($clientName, $clientMail): Response
    {
        $client = $this->dataBase->clientToAdd($clientName, $clientMail);
        $this->hubspot->createClient($client);

        return new Response('Creating hubspot client for '.$clientName.' '.$clientMail, 200);
    }
}
