<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Yoanbernabeu\AirtableClientBundle\AirtableClientInterface;

class AirtableController extends AbstractController
{
    #[Route('/airtable', name: 'app_airtable')]
    public function index(AirtableClientInterface $airtable): Response
    {
        return $this->render('airtable/index.html.twig', [
            'controller_name' => 'AirtableController',
        ]);
    }
}
