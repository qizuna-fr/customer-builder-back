<?php

namespace App\Controller;

use App\Entity\GenCssFile;
use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CSSManagementInterface;
use App\Interfaces\DataBaseManagementInterface;
use App\Interfaces\FormattingTextInterface;
use App\Interfaces\GitServiceInterface;
use App\Interfaces\ImaginaryServiceInterface;
use App\Interfaces\BillingServiceInterface;
use App\Services\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\ZipFile;

class ServicesController extends AbstractController
{
    public function __construct(
        private GitServiceInterface $github,
        private FormattingTextInterface $formattingText,
        private CSSManagementInterface $cssManagement,
        private ImaginaryServiceInterface $imaginary,
        private DataBaseManagementInterface $dataBase,
        private CRMServiceInterface $hubspot,
        private BillingServiceInterface $billing,
    ) {
    }

    public function getClientByCityName($cityName): Customer
    {
        $client = $this->dataBase->fetchCustomerByCityName($cityName);
        $clientDataId = $client->getDatas();
        $clientDatas = [];
        foreach ($clientDataId as $id) {
            $data = $this->dataBase->getClientData($id);
            array_push($clientDatas, $data);
        }
        // dd($dataClientRecords);
        $dataClientParagraphStyle = [];
        $dataClientTitleStyle = [];
        $dataClientFiles = [];
        $paragraphStyle = ["normal", "normal", "normal"];
        $titleStyle = ["normal", "normal", "normal"];
        $paragraphFont = "";
        $titleFont = "";
        $paragraphColor = "";
        $titleColor = "";
        // dd($clientDatas);
        foreach ($clientDatas as $dataClient) {
            if ($dataClient->VariableName == 'StyleEcritureParagraphes') $paragraphStyle = explode(" ", $dataClient->Choices);
            if ($dataClient->VariableName == 'StyleEcritureTitre') $titleStyle = explode(" ", $dataClient->Choices);
            if ($dataClient->VariableName == 'PoliceParagraphe') $paragraphFont = $dataClient->Choices;
            if ($dataClient->VariableName == 'PoliceTitre') $titleFont = $dataClient->Choices;
            if ($dataClient->VariableName == 'CouleurParagraphes') $paragraphColor = $dataClient->Choices;
            if ($dataClient->VariableName == 'CouleurTitlre') $titleColor = $dataClient->Choices;
            if ($dataClient->VariableName == 'LogoCommune') $file = $dataClient->Choices;
        }
        $dataClientParagraphStyle = [
            'font' => $paragraphFont,
            'color' => $paragraphColor,
            'text-transform' => $paragraphStyle[0],
            'font-weight' => $paragraphStyle[1],
            'font-style' => $paragraphStyle[2]
        ];
        // dd($dataClientParagraphStyle);
        $dataClientTitleStyle = [
            'font' => $titleFont,
            'color' => $titleColor,
            'text-transform' => $titleStyle[0],
            'font-weight' => $titleStyle[1],
            'font-style' => $titleStyle[2]
        ];
        $dataClientFiles = [
            'name' => $file
        ];
        $client->setTitleStyle($dataClientTitleStyle);
        $client->setParagraphStyle($dataClientParagraphStyle);
        $client->setFiles($dataClientFiles);
        return $client;
    }


    #[Route('/qizuna/client-information', name: 'client-information')]
    public function clientByCityName(Request $request): Response
    {
        $cityName = $request->get("cityName");
        // $dataBase = new DataBaseManagement();
        $client = $this->getClientByCityName($cityName);

        return $this->render('airtable/index.html.twig', [
            'client' => $client
        ]);
    }

    #[Route('/qizuna/client-list', name: 'client-list')]
    public function clientList(): Response
    {
        $clientList = $this->dataBase->getClientList();
        $clients = [];
        foreach ($clientList as $record) {
            $dataClient = $record->fields;
            $airtableClient = new Customer($dataClient->Id, $dataClient->CityName, $dataClient->Email, $dataClient->Data);
            array_push($clients, $airtableClient);
        }
        // dd($clients);
        return $this->render('airtable/clientList.html.twig', [
            'clients' => $clients
        ]);
    }

    #[Route('/qizuna')]
    public function index(): Response
    {

        $client = $this->getClientByCityName("Mulhouse");
        $clientParagraphStyle = $client->getParagraphStyle();
        $clientTextStyle = $client->getTitleStyle();

        $clientFile = $client->getFiles();
        $clientLogo = $clientFile["name"];
        $genCss = new GenCssFile($clientParagraphStyle, $clientTextStyle);

        $zip = new ZipFile("Assets/qizuna.zip");
        $zip->add("Assets/qizunaCity.css");
        $zip->add("Assets/" . $clientLogo);
        $zip->export();

        echo ("<br> Zip generated <br>");

        // dd($client->getParagraphStyle());
        // dd($client->getFiles());


        // $customerEmail=$customerData['email'];

        // $text = $customerData['cityName'];
        // $lowerCaseText = $this->formattingText->lowerCase($text);
        // $formattedText = $this->formattingText->deleteSpace($lowerCaseText);

        // $this->cssManagement->editColor('title', 'black');
        // $customerData['title']['color'] = 'black';

        // $this->cssManagement->editStyle('paragraph', 'normal');
        // $customerData['paragraph']['style'] = 'normal';

        // $image = new DummyImaginaryFile();
        // $imageCustomer = $customerData['files']['logo'];
        // $image->name($imageCustomer['name']);
        // $image->setExtension($imageCustomer['extension']);
        // $image->setWidth($imageCustomer['width']);
        // $image->setHeight($imageCustomer['height']);

        // $higth = 250;
        // $width = 250;

        // $newExtension = "jpg";

        // $this-> imaginary->connect();

        // try{
        //     $this->imaginary->resizeImage($image, $higth, $width);
        //     // $customerData['files']['logo']['height'] = $higth;
        //     // $customerData['files']['logo']['width'] = $width;

        //     $this->imaginary->convertFile($image, $newExtension);
        //     // $customerData['files']['logo']['extension'] = $newExtension;
        // }
        // catch(ConnectionImaginaryException $e){
        //     echo 'Exception reçue : ',  $e->getMessage(), "\n";
        // }

        // $this->dataBase->persist();

        // $file = new DummyGitFile();
        // $file->setData($customerData);
        // $branchName = 'update data client';
        // $message = 'updated at '.date('h:i:sa');

        // $this->github->connect();

        // try{
        //     $this->github->add($file, $branchName);
        //     $this->github->commit($branchName, $message);
        //     $this->github->push($file, $branchName, $message);
        // }
        // catch(Exception $e){
        //     echo 'Exception reçue : ',  $e->getMessage(), "\n";
        // }

        // try{
        //     $this->billing->connect();

        //     $customerName=$customerData['cityName'];
        //     // $customerEmail=$customerData['email'];
        //     $customerData = array ();

        //     $customer = new Customer($customerName, $customerEmail, $customerData);

        //     // $this->billing->create($customer);
        //     // $this->billing->subscribe($customerId);

        //     $this->billing->disconnect();
        // }
        // catch(Exception $e){
        //     echo 'Exception reçue : ',  $e->getMessage(), "\n";
        // }

        // echo ("billing connection <br>");
        // $connection = new ApiConnection();
        // $response = $connection->billing();
        // dump($response);

        // $httpClient = HttpClient::create();
        // $response = $httpClient->request('GET', 'http://localhost:8000/billing/1');

        // $statusCode = $response->getStatusCode();
        // echo $statusCode."</br>";

        return new Response("qizuna", 200);
    }

    // $cssfile = new GenCssFile($testArray);

    // $zip = new GenZipFile("F:\qizuna.zip");
    // $zip->add("qizunaCity.css");
    // $zip->add("index.php");
    // $zip->export();

    //     return new Response("", 200);
    // }
}
