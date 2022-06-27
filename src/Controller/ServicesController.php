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
        $dataClientParagraphStyle = [];
        $dataClientTitleStyle = [];
        $dataClientFiles = [];
        $paragraphStyle = ["normal", "normal", "normal"];
        $titleStyle = ["normal", "normal", "normal"];
        $paragraphFont = "";
        $titleFont = "";
        $paragraphColor = "";
        $titleColor = "";
        foreach ($clientDatas as $dataClient) {
            if ($dataClient->VariableName == 'StyleEcritureParagraphes') $paragraphStyle = explode(" ", $dataClient->Choices);
            if ($dataClient->VariableName == 'StyleEcritureTitre') $titleStyle = explode(" ", $dataClient->Choices);
            if ($dataClient->VariableName == 'PoliceParagraphe') $paragraphFont = $dataClient->Choices;
            if ($dataClient->VariableName == 'PoliceTitre') $titleFont = $dataClient->Choices;
            if ($dataClient->VariableName == 'CouleurParagraphes') $paragraphColor = $dataClient->Choices;
            if ($dataClient->VariableName == 'CouleurTitre') $titleColor = $dataClient->Choices;
            if ($dataClient->VariableName == 'LogoCommune') $file = $dataClient->uploadFile;
        }
        $dataClientParagraphStyle = [
            'font' => $paragraphFont,
            'color' => $paragraphColor,
            'text-transform' => $paragraphStyle[2],
            'font-weight' => $paragraphStyle[1],
            'font-style' => $paragraphStyle[0]
        ];
        $dataClientTitleStyle = [
            'font' => $titleFont,
            'color' => $titleColor,
            'text-transform' => $titleStyle[2],
            'font-weight' => $titleStyle[1],
            'font-style' => $titleStyle[0]
        ];
        $dataClientFiles = [
            'name' => $file[0]->filename,
            'url' => $file[0]->url,
            'width' => $file[0]->width,
            'height' => $file[0]->height,
            'filename' => $file[0]->filename,
            'size' => $file[0]->size,
            'type' => $file[0]->type
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
        $client = $this->getClientByCityName($cityName);
        $imageUrl = $client->getFiles()['url'];
        $fileName = $client->getFiles()['name'];
        file_put_contents('Temp\\'.$fileName, file_get_contents($imageUrl));
        $defaults = [
            'Width' => $client->getFiles()["width"],
            'Height' => $client->getFiles()["height"],
        ];
        $form = $this->createFormBuilder($defaults)
            ->add('Width', NumberType::class)
            ->add('Height', NumberType::class)
            ->add('Valider', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        $submittedToken = $request->request->get('token');
        if ($form->isSubmitted() && $this->isCsrfTokenValid('image-resize', $submittedToken)) {
            $formParameters = $form->getData();
            $width  = $formParameters['Width'];
            $height  = $formParameters['Height'];
            $newimage = $this->imaginary->resizeImage($imageUrl, $width, $height);
            file_put_contents('Temp\\' . $fileName, $newimage);
            $this->redirectToRoute('image-edit');
        }
        return $this->render('airtable/index.html.twig', [
            'client' => $client,
            'form' => $form->createView()
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
        $newimage = $this->imaginary->resizeImage($image, 100, 100);
        file_put_contents('Temp\\' . $fileName, $newimage);
        return $this->render('imaginary/index.html.twig', [
            'imageurl' => $image,
            'imageFile' => $client->getFiles()
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
        new GenCssFile($cityName, $clientParagraphStyle, $clientTextStyle);
        $zip = new ZipFile("Temp/" . $cityName . ".zip");
        $zip->add("Temp/" . $cityName . ".css");
        $zip->add("Temp/" . $clientLogo);
        $zip->export();
        unlink("Temp/".$clientLogo);
        unlink("Temp/" . $cityName. ".css");
        echo ("<br> Zip generated for " . $cityName . " <br>");
        return new Response("qizuna", 200);
    }
}
