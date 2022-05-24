<?php

namespace App\Tests;

use App\Services\Dummy\DummyDataBaseManagement;
use App\Services\Dummy\DummyHubspotService;
use App\Services\FormattingText;
use App\Services\GitHubService;
use App\Services\ImaginaryService;
use App\Services\TextCSSManagement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\Dummy\DummyClient;
use App\Services\PennyLaneService;

class ServicesTest extends WebTestCase
{

    public function testFormatCityName(): void
    {
        $client = static::createClient();
        $client->request('GET', '/format-city-name');
        $this->assertSame($client->getResponse()->getStatusCode(), 200);
    }

    public function testFormattingText(): void
    {
        $formattingText = new FormattingText();
        $text = "Hello Word";
        $formattedText = $formattingText->deleteSpace($text);
        $this->assertSame($formattedText, "hello-word");
    }

    public function testDefineFont(): void
    {
        $client = static::createClient();
        $client->request('GET', '/edit-font/title/Open Sans');
        $this->assertSame($client->getResponse()->getContent(), "Editing title font to Open Sans");
    }

    public function testTextCSSManagement(): void
    {
        $textManagement = new TextCSSManagement();
        $text = "Mulhouse";

        $textFont = "Open Sans";
        $textManagement->editTextFont($text, $textFont);
        $this->assertSame($textManagement->spyFont, true);

        $textStyle = "capitalize";
        $textManagement->editTextStyle($text, $textStyle);
        $this->assertSame($textManagement->spyStyle, true);
        
        $textColor = "bold";
        $textManagement->editTextColor($text, $textColor);
        $this->assertSame($textManagement->spyColor, true);
    }

    public function testIndexResizeImage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/resize/clientLogo/120/200');
        $this->assertSame($client->getResponse()->getContent(), "resizing image clientLogo");
    }
    
    public function testConnectionToImaginary(): void
    {
        $service = new ImaginaryService();
        $service->connectToImaginary();
        $this->assertSame($service->spy, true);
    }

    public function testDisconnectionFromImaginary(): void
    {
        $service = new ImaginaryService();
        $this->assertSame($service->disconnectFromImaginary(), 'Disconnected');
    }

    public function testConnectionToGithub(): void
    {
        $service = new GitHubService();
        $service->connectToGithub();
        $this->assertSame($service->spy, true);
    }

    public function testDisconnectionFromGithub(): void
    {
        $service = new GitHubService();
        $this->assertSame($service->disconnectFromGithub(), 'Disconnected');
    }

    public function testIndexCreateClientHubspot(): void
    {
        $client = static::createClient();
        $client->request('GET', '/create-client-hubspot/colmar/colmar@colmar.fr');
        $this->assertSame($client->getResponse()->getContent(), 'Creating hubspot client for colmar colmar@colmar.fr');
    }

    public function testConnectionToHubspot(): void
    {
        $service = new DummyHubspotService();
        $service->connectToHubspot();
        $this->assertSame($service->spyconnect, true);
    }

    public function testDisconnectionFromHubspot(): void
    {
        $service = new DummyHubspotService();
        $this->assertSame($service->disconnectFromHubspot(), 'Disconnected');
    }

    public function testCreateClientHubspot(): void
    {
        $dummyDataBase = new DummyDataBaseManagement();
        $clientName = 'Colmar';
        $clientMail = 'colmar@mail.fr';
        $service = new DummyHubspotService();
        if (!$service->exist($clientName, $service->getHubspotClientList())) {
            $service->createClient($dummyDataBase->clientToAdd($clientName, $clientMail));
        }
        $this->assertSame($service->spycreate, true);
    }

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
