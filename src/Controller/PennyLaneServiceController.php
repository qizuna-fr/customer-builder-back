<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\PennyLaneService;

class PennyLaneServiceController extends AbstractController
{
    #[Route('/penny/lane/service', name: 'app_penny_lane_service')]

    public function __construct(private PennyLaneService $pennyLane)
    {
    }

    #[Route('/pennylane/create')]
    public function create(): Response
    {
        if ($this->pennyLane->connect()) {
         
            if (!$this->pennyLane->exist()) {
                
             if ($this->pennyLane->create())
                $response = new Response("PennyLane create Service : ok ", http_response_code(240) );
            } else
                $response = new Response("PennyLane create Service, creation error ");

            $this->pennyLane->disconnect();
        }
        else
        $response = new Response("PennyLane create service, connection error");

        return $response;
    }

    #[Route('/pennylane/delete')]
    public function delete(): Response
    {

        if ($this->pennyLane->connect()) {
         
            if (!$this->pennyLane->exist()) {
                
             if ($this->pennyLane->delete())
                $response = new Response("PennyLane delete service : ok ");
            } else
                $response = new Response("PennyLane delete service, delete error ");

            $this->pennyLane->disconnect();
        }
        else
        $response = new Response("PennyLane delete service, connection error");

        return $response;
    }


    #[Route('/pennylane/subscription')]
    public function subscription(): Response
    {
        if ($this->pennyLane->connect()) {
         
            if (!$this->pennyLane->exist()) {
                
             if ($this->pennyLane->subscription())
                $response = new Response("PennyLane subcription service : ok ");
            } else
                $response = new Response("PennyLane subscription service,  error ");

            $this->pennyLane->disconnect();
        }
        else
        $response = new Response("PennyLane subscription service, connection error");

        return $response;
    }

    #[Route('/pennylane/unsubscription')]
    public function unsubscription(): Response
    {
        if ($this->pennyLane->connect()) {
         
            if (!$this->pennyLane->exist()) {
                
             if ($this->pennyLane->unsubscription())
                $response = new Response("PennyLane unsubcription service : ok ");
            } else
                $response = new Response("PennyLane unsubscription service,  error ");

            $this->pennyLane->disconnect();
        }
        else
        $response = new Response("PennyLane unsubscription service, connection error");

        return $response;
  
    }

    #[Route('/pennylane/billing')]
    public function billing(): Response
    {
        if ($this->pennyLane->connect()) {
         
            if (!$this->pennyLane->exist()) {
                
             if ($this->pennyLane->billing())
                $response = new Response("PennyLane billing service : ok ");
            } else
                $response = new Response("PennyLane billing service,  error ");

            $this->pennyLane->disconnect();
        }
        else
        $response = new Response("PennyLane billing service, connection error");

        return $response;
  
    }

}
