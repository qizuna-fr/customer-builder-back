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
use App\Interfaces\BillingServiceInterface;
use App\Services\Customer;
use App\Services\Dummy\DummyGitFile;
use App\Services\Dummy\DummyImaginaryFile;
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
        private CRMServiceInterface $hubspot,
        private BillingServiceInterface $billing
    ) 
    {
    }

    #[Route('/qizuna')]
    public function index() : Response
    {
        $customerId = 1;
        $customerData = $this->dataBase->fetchData($customerId);

        $text = $customerData['cityName'];
        $lowerCaseText = $this->formattingText->lowerCase($text);
        $formattedText = $this->formattingText->deleteSpace($lowerCaseText);

        $this->cssManagement->editColor('title', 'black');
        $customerData['title']['color'] = 'black';

        $this->cssManagement->editStyle('paragraph', 'normal');
        $customerData['paragraph']['style'] = 'normal';

        $image = new DummyImaginaryFile();
        $imageCustomer = $customerData['files']['logo'];
        $image->name($imageCustomer['name']);
        $image->setExtension($imageCustomer['extension']);
        $image->setWidth($imageCustomer['width']);
        $image->setHeight($imageCustomer['height']);

        $higth = 250;
        $width = 250;

        $newExtension = "jpg";

        $this-> imaginary->connect();

        try{
            $this->imaginary->resizeImage($image, $higth, $width);
            // $customerData['files']['logo']['height'] = $higth;
            // $customerData['files']['logo']['width'] = $width;

            $this->imaginary->convertFile($image, $newExtension);
            // $customerData['files']['logo']['extension'] = $newExtension;
        }
        catch(ConnectionImaginaryException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        // $this->dataBase->persist();

        $file = new DummyGitFile();
        $file->setData($customerData);
        $branchName = 'update data client';
        $message = 'updated at '.date('h:i:sa');

        $this->github->connect();

        try{
            $this->github->add($file, $branchName);
            $this->github->commit($branchName, $message);
            $this->github->push($file, $branchName, $message);
        }
        catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
   
        
        try{
            $this->billing->connect();

            $customerName=$customerData['cityName'];
            $customerEmail=$customerData['email'];
            $customerData = array ();

            $customer = new Customer($customerName, $customerEmail, $customerData);

            $this->billing->create($customer);
            $this->billing->subscribe($customerId);

            $this->billing->disconnect();
        }
        catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

   
        return new Response("qizuna", 200);

    }

}
?>