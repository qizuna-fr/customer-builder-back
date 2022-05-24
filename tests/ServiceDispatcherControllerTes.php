<?php

namespace App\Tests;

use App\Controller\ServiceDispatcherController;
use App\Interfaces\PennyLaneServiceInterface;
use App\Services\PennyLaneService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ServiceDispatcherControllerTest extends TestCase
{
    
    public function testDispatcher(): void
    {
        $request = Request::create(
            '<uri>', 
            'GET', 
            [], 
            [], 
            [], 
            [], 
            ['pennyLane' => 'coucou',
            'imaginary' => 'oiseau']
         );

         $pennylane= new PennyLaneService();

        $newDispatcher = new ServiceDispatcherController($pennylane);
        $newDispatcher-> serviceDispatcher($request);

    }
}