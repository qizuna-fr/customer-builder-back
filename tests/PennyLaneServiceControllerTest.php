<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PennyLaneServiceControllerTest extends WebTestCase
{
    public function testPennyLaneCreate(): void
    {
        $client = static::createClient();
       
        $crawler = $client->request('GET','/pennylane/create');

        $this->assertResponseIsSuccessful();

    }

    public function testPennyLaneDelete(): void
    {
        $client = static::createClient();
       
        $crawler = $client->request('GET','/pennylane/delete');

        $this->assertResponseIsSuccessful();

    }
}
