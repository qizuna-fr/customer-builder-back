<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Yoanbernabeu\AirtableClientBundle\AirtableClientInterface;

class DataBaseController extends AbstractController
{
    #[Route('/data/base', name: 'app_data_base')]
    public function index(AirtableClientInterface $airtableClient): Response
    {
        $airtableClient->findAll('tableName', 'viewName', Foo::class);
        return $this->render('data_base/index.html.twig', [
            'controller_name' => 'DataBaseController',
        ]);
    }
}
