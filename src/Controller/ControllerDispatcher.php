<?php

namespace App\Controller;

use App\Interfaces\ClientInterface;
use App\Interfaces\DataBaseManagementInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerDispatcher extends AbstractController
{

    // private $data = [];
    // private $clientData = [];

    // public function __construct(
    //     private DataBaseManagementInterface $dataBase,
    //     private ServicesController $controller
    // ) 
    // {
    //     $this->data = $this->dataBase->fetchDataFromDataBase($this->client->getClientName());
    //     // $dataBase = new DummyDataBaseManagement();
    //     $this->clientData = $dataBase->fetchDataFromDataBase($this->client->getClientName());
    // }

    // #[Route('/qizuna-dispatcher')]
    // public function qizuna_dispatcher()
    // {
    //     echo ("Données du client : ");
    //     var_dump($this->clientData);
    //     echo ("<br>");

    //     // $cityName = $this->clientData["cityName"];
    //     // $titleFont = $this->clientData["titleFont"];
    //     // $titleColor = $this->clientData["titleColor"];
    //     // $titleStyle = $this->clientData["titleStyle"];
    //     // $paragraphFont = $this->clientData["paragraphFont"];
    //     // $paragraphColor = $this->clientData["paragraphColor"];
    //     // $paragraphStyle = $this->clientData["paragraphStyle"];
    //     // $clientFileOne = $this->clientData["clientFiles"]["clientLogo"];
    //     // $clientFileTow = $this->clientData["clientFiles"]["clientBackground"];

    //     echo ("<br> <br>");

    //     echo ("Appel de formatCityName : <br>");
    //     $this->controller->formatCityName();

    //     echo ("Appel de defineFont title : <br>");
    //     $this->controller->defineFont('title', 'Open sans');

    //     echo ("Appel de defineStyle paragraph : <br>");
    //     $this->controller->defineStyle('paragraph', 'bold');

    //     echo ("Appel de defineColor title : <br>");
    //     $this->controller->defineColor('title', '#00000');

    //     echo ("Appel de resize image : <br>");
    //     $this->controller->resizeImage(120,120, $this->clientData["clientFiles"]["clientLogo"]);

    //     echo ("Appel de creatPennyLaneClient : <br>");
    //     // $this->controller->createPennyLaneClient($clientName);

    //     $this->controller->updateGithub();

    //     return new Response("dispatcher controller");
    // }

}
