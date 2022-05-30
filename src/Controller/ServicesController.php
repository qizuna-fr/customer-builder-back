<?php

namespace App\Controller;

use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use App\Interfaces\DataBaseManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use App\Interfaces\PennyLaneServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends AbstractController
{
    private $customerData = [];

    public function __construct(
        private GitServiceInterface $github,
        private FormattingTextInterface $formattingText,
        private ImaginaryServiceInterface $imaginary,
        private DataBaseManagementInterface $dataBase,
        private CustomerInterface $customer,
        private CRMServiceInterface $hubspot,
        private PennyLaneServiceInterface $pennyLane
    ) 
    {
        $this->customerData = $this->dataBase->fetchData($this->customer);
    }

    public function formatCityName(): Response
    {
        $formattedCityName = $this->formattingText->deleteSpace($this->customerData["cityName"]);
        $this->customerData['cityName'] = $formattedCityName;
        return new Response("Formatting city name", 200);
    }

    public function defineFont(string $variable, string $value): Response
    {
        if (!in_array($variable, $this->customerData)) throw new Exception($variable . "n'existe pas !");
        $this->customerData[$variable] = $value;
        return new Response('Editing ' . $variable . ' to ' . $value, 200);
    }

    public function resizeImage(ImaginaryFileInterface $clientFile, int $width, int $hight): Response
    {
        $this->imaginary->resizeImage($clientFile, $width, $hight);
        $clientFile->setHight($hight);
        $clientFile->setWidth($width);
        return new Response('resizing image ' . $clientFile, 200);
    }

    public function convertFile(ImaginaryFileInterface $clientFile, string $extension): Response
    {
        $this->imaginary->convertFile($clientFile, $extension);
        $clientFile->setExtension($extension);
        return new Response('resizing image ' . $clientFile, 200);
    }

    public function createHubspotCustomer(CustomerInterface $customer): Response
    {
        $this->hubspot->createCustomer($customer);
        return new Response('Creating hubspot client for ' . $customer->getName(), 200);
    }

    public function updateDataBase(){
        $this->customer->setData($this->customerData);
        $this->dataBase->persistData($this->customer);
    }

    public function githubService() {
        $file = new GitFileInterface();
        $file->setData($this->customerData);
        $branchName = 'update data client'.$this->client->getClientName();
        $message = 'updated at '.date('h:i:sa');
        $this->github->push($file, $branchName, $message);
    }

}
