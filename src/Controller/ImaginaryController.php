<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImaginaryController extends AbstractController
{
    #[Route('/edit-file')]
    public function index(): Response
    {
        
        return $this->render('imaginary/index.html.twig', [
            'controller_name' => 'ImaginaryController',
        ]);
    }
}
