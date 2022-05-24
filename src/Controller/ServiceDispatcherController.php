<?php

namespace App\Controller;

use App\Interfaces\PennyLaneServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceDispatcherController extends AbstractController
{
    private $pennyLane;

    public function __construct(PennyLaneServiceInterface $pennyLane)
    {
        $this->pennyLane = $pennyLane;
    }

    public function serviceDispatcher(Request $request)
    {

        $param = $request->getContent();
        $pennylaneData = $param['pennyLane'];

        // echo $pennylaneData;


        try {
            $this->pennyLane->create($pennylaneData);
        } catch (Exception $e) {
            echo 'Exception :' . $e->getMessage() . " \n";
        }
    }
}