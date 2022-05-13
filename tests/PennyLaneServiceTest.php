<?php

namespace App\Tests;

use App\Services\Dummy\DummyPennyLaneService;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PennyLaneServiceTest extends WebTestCase
{
    public function testConnection(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->connect(), 'Connection error');
    }
    public function testExist(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->exist(), "not existant");
    }

    public function testCreate(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->create(), "create error");
    }


    public function testSubscribtion(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->subscription(), "subscription ko");
    }

    
    public function testUnSubscribtion(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->unsubscription(), "unsubscription ko");
    }

    public function testBilling(): void
    {
        $service = new DummyPennyLaneService();
        $this->assertTrue($service->billing(), "billing ko");
    }


}
