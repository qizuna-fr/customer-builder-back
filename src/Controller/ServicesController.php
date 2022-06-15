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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            if ($dataClient->VariableName == 'LogoCommune') $file = $dataClient->uploadFile;
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
            'name' => $file[0]->filename,
            'url' => $file[0]->url,
            'width'=> $file[0]->width,
            'height'=> $file[0]->height,
            'filename'=> $file[0]->filename,
            'size'=> $file[0]->size,
            'type'=> $file[0]->type
        ];
        // dd($dataClientFiles);
        $client->setTitleStyle($dataClientTitleStyle);
        $client->setParagraphStyle($dataClientParagraphStyle);
        $client->setFiles($dataClientFiles);
        // dd($client);
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
    
    #[Route('/qizuna/image-edit', name: 'image-edit')]
    public function imageEdit(Request $request): Response
    {
        $cityName = $request->get("cityName");
        $client = $this->getClientByCityName($cityName);
        $image = $client->getFiles()['url'];
    
        $fileName = $request->get("fileName");

        $data = array(
            'number' => 10,
            'number' => 10,
            'number' => 10,
            'value' => null,
            'string' => 'No value',
        );
        $form = $this->createFormBuilder($data)
            ->add('Width', NumberType::class, array('attr' => array('placeholder' => 'new width')))
            ->add('Height', NumberType::class, array('attr' => array('placeholder' => 'new height')))
            ->add('Type', NumberType::class, array('attr' => array('placeholder' => 'new type')))
            ->add('Valider', SubmitType::class)
            ->getForm();

            // if ($request->isMethod('POST')) {
            // $form->submit($request->request->get($form->getName()));
            // dd($form);
            //     if ($form->isSubmitted()) {
            //     /**@var array $parameterForm */
            //     $parameterForm = $request->request->get('form');
            //     $connexionFlag = (array_key_exists("Valider", $parameterForm));
            //     $width  = $request->request->get('form')['Width'];
            //     $height = $request->request->get('form')['Height'];
            //     $type = $request->request->get('form')['Type'];

            //     if ($connexionFlag) {

            //         $newimage = $this->imaginary->resizeImage($image, $width,$height);
            
            //         file_put_contents('Assets\\'.$fileName, $newimage);
            //     }
            // }
        // }
        $newimage = $this->imaginary->resizeImage($image, 100,100);
            
        file_put_contents('Assets\\'.$fileName, $newimage);

        // return new Response("imaginary service here", 200);
        // http://localhost:9000/info?file=qizuna.png image properties
        return $this->render('imaginary/index.html.twig', [
           'imageurl' => $image,
           'imageFile' =>$client->getFiles(),
           'form' => $form->createView(),
        ]);
    }

    #[Route('/qizuna/css-generate', name: 'css-generate')]
    public function cssGenerate(Request $request): Response
    {

        $cityName = $request->get("cityName");
        $client = $this->getClientByCityName($cityName);
        $clientParagraphStyle = $client->getParagraphStyle();
        $clientTextStyle = $client->getTitleStyle();

        $clientFile = $client->getFiles();
        $clientLogo = $clientFile["name"];
        $genCss = new GenCssFile($cityName, $clientParagraphStyle, $clientTextStyle);

        $zip = new ZipFile("Assets/" . $cityName . ".zip");
        $zip->add("Assets/" . $cityName . ".css");
        $zip->add("Assets/" . $clientLogo);
        $zip->export();

        echo ("<br> Zip generated for " . $cityName . " <br>");

        return new Response("qizuna", 200);
    }
}
