<?php

namespace App\Controller;

use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CSSManagementInterface;
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
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    private $customerData = [];

    public function __construct(
        private GitServiceInterface $github,
        private FormattingTextInterface $formattingText,
        private CSSManagementInterface $cssManagement,
        private ImaginaryServiceInterface $imaginary,
        private DataBaseManagementInterface $dataBase,
        private CustomerInterface $customer,
        private CRMServiceInterface $hubspot,
        private PennyLaneServiceInterface $pennyLane
    ) 
    {
        $this->customerData = $this->dataBase->fetchData($this->customer);
    }

    // public function formatCityName()
    // {
    //     $formattedCityName = $this->formattingText->deleteSpace($this->customerData["cityName"]);
    //     $this->customerData['cityName'] = $formattedCityName;
    // }

    // // public function cssManagement(string $variable, string $value)
    // // {
    // //     if (!in_array($variable, $this->customerData)) throw new Exception($variable . "n'existe pas !");
    // //     $this->customerData[$variable] = $value;
    // // }

    // public function resizeImage(ImaginaryFileInterface $clientFile, int $width, int $hight)
    // {
    //     $this->imaginary->resizeImage($clientFile, $width, $hight);
    //     $clientFile->setHight($hight);
    //     $clientFile->setWidth($width);
    // }

    // public function convertFile(ImaginaryFileInterface $clientFile, string $extension)
    // {
    //     $this->imaginary->convertFile($clientFile, $extension);
    //     $clientFile->setExtension($extension);
    // }

    // public function createHubspotCustomer(CustomerInterface $customer)
    // {
    //     $this->hubspot->createCustomer($customer);
    // }

    // public function updateDataBase(){
    //     $this->customer->setData($this->customerData);
    //     $this->dataBase->persistData($this->customer);
    // }

    // public function pushToGithub(GitFileInterface $file) {
    //     $branchName = 'update data client'.$this->client->getClientName();
    //     $message = 'updated at '.date('h:i:sa');
    //     $this->github->push($file, $branchName, $message);
    // }

    #[Route('/qizuna')]
    public function index()
    {
        $formattedCityName = $this->formattingText->deleteSpace($this->customerData["cityName"]);
        $this->customerData['cityName'] = $formattedCityName;

        $this->cssManagement->editColor('titleColor', 'black');
        $this->customerData['titleColor'] = 'black';

        $this->cssManagement->editStyle('paragraphStyle', 'normal');
        $this->customerData['paragraphStyle'] = 'normal';

        $image = new ImaginaryFileInterface();
        $imageCustomer = $this->customerData['clientFiles']['clientLogo'];
        $image->name($imageCustomer['name']);
        $image->setExtension($imageCustomer['extension']);
        $image->setWidth($imageCustomer['width']);
        $image->setHight($imageCustomer['higth']);

        $this->imaginary->resizeImage($image, 250, 200);
        $image->setHight(250);
        $image->setWidth(200);

        $this->imaginary->convertFile($image, "jpg");
        $image->setExtension("jpg");

        $this->customer->setData($this->customerData);
        $this->dataBase->persistData($this->customer);

        $file = new GitFileInterface();
        $file->setData($this->customerData);
        $branchName = 'update data client'.$this->client->getClientName();
        $message = 'updated at '.date('h:i:sa');
        $this->github->push($file, $branchName, $message);

    }

}
