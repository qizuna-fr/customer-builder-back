<?php

namespace App\Controller;

use App\Interfaces\ImaginaryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImaginaryController extends AbstractController
{
    #[Route('/resize-image')]
    public function resizeImage(Request $request): Response
    {
        $this->imaginary->connectToImaginary();
        $file = $request->files[0];
        $editedFile = $this->imaginary->resizeImage($file);

        return $this->render('imaginary/index.html.twig', [
            'controller_name' => 'ImaginaryController',
        ]);
    }
}
