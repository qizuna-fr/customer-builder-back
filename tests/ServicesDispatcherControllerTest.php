<?php

namespace App\Tests;

use App\Services\Dummy\DummyClient;
use App\Services\PennyLaneService;

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{
    public int $client_id=0;

    public function testPennyLaneServiceCreate(): void
    {
        $client = new DummyClient();
        $clientAirtable = $client->getAirTableClient();

        $pennylane = new PennyLaneService();
        $this->client_id = $pennylane->create($clientAirtable);
        $this->assertNotNull($this->client_id, "Client_id error");
        $this->getExpectedExceptionMessage("Client yet created");
        $this->getExpectedExceptionMessage("Authentification error");
    }

    public function testPennyLaneServiceSubscribe(): void
    {
        $pennylane = new PennyLaneService();
        $subscribe = $pennylane->subscribe($this->client_id);
        $this->assertTrue($subscribe, "Subscription error");
        $this->getExpectedExceptionMessage("Authentification error");

    }
}