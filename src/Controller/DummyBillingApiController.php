<?php

namespace App\Controller;

use Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DummyBillingApiController extends AbstractController
{
    #[Route('/billing/{index}', name: 'app_dummy_billing_api')]
    public function index($index, Request $request)
    {
        // return $this->render('dummy_billing_api/index.html.twig', [
        //     'controller_name' => 'DummyBillingApiController',
        // ]);

        echo ("Index :".$index."<br>");
        dump($request);

        $response = new Response();
        $response->setContent("Hello de Lu");
        $response->setStatusCode(400);

        return $response;
    }
}
