<?php

namespace App\Controller;

use App\Services\DataBaseManagement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Yoanbernabeu\AirtableClientBundle\AirtableClientInterface;

class AirtableController extends AbstractController
{
    #[Route('/show-client/{cityName}', name: 'app_airtable')]
    public function index(AirtableClientInterface  $airtable, string $cityName): Response
    {
        $dataBase = new DataBaseManagement($airtable);
        $client = $dataBase->fetchByCityName($cityName);
        // dd($client->getData());
        return $this->render('airtable/index.html.twig', [
            'client' => $client
        ]);
    }
}
