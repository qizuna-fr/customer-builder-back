<?php

namespace App\Controller;

use App\Exceptions\ConnectionImaginaryException;
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
use App\Tests\DummyCustomer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends AbstractController
{
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
    }

    #[Route('/qizuna')]
    public function index() : Response
    {
        $customer = new DummyCustomer;

        $formattedText = $this->formattingText->deleteSpace($this->customerData['cityName']);

        $this->cssManagement->editColor('title', 'black');
        // $this->customerData['title']['color'] = 'black';

        $this->cssManagement->editStyle('paragraph', 'normal');
        // $this->customerData['paragraph']['style'] = 'normal';

        $image = new ImaginaryFileInterface();
        $imageCustomer = $this->customerData['files']['logo'];
        $image->name($imageCustomer['name']);
        $image->setExtension($imageCustomer['extension']);
        $image->setWidth($imageCustomer['width']);
        $image->setHight($imageCustomer['higth']);

        $higth = 250;
        $width = 250;

        $newExtension = "jpg";

        try{
            $this->imaginary->resizeImage($image, $higth, $width);

            $this->imaginary->convertFile($image, $newExtension);
        }
        catch(ConnectionImaginaryException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        $this->dataBase->persist($this->customer, $this->customerData);

        $file = new GitFileInterface();
        $file->setData($this->customerData);
        $branchName = 'update data client'.$this->client->getClientName();
        $message = 'updated at '.date('h:i:sa');

        try{
            $this->github->push($file, $branchName, $message);
        }
        catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        

        // $billing= new BillingService();
        //     $billing->create($this->customer);
        //     $billing->subscribe($this->customer->getId());

        return new Response("qizuna", 200);

    }

}
?>