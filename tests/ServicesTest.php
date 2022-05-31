<?php

namespace App\Tests;

use App\Exceptions\ConnectionImaginaryException;
use App\Exceptions\DimensionErrorException;
use App\Services\CSSManagementService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\FormattingTextService;
use App\Services\ImaginaryService;

class ServicesTest extends WebTestCase
{

    public function testFormatTextIsCalled(): void
    {
        $client = static::createClient();
        $client->request('GET', '/qizuna');
    }

    public function testFormatTextService(): void
    {
        $formattingText = new FormattingTextService();
        $text = "Hello Word";
        $formattedText = $formattingText->deleteSpace($text);
        $this->assertSame($formattedText, "hello-word");
    }

    public function testCSSManagementService(): void
    {
        $cssManagement = new CSSManagementService();
        $text = "title";

        $textFont = "Open Sans";
        $cssManagement->editFont($text, $textFont);

        $this->assertSame($cssManagement->spyFont, true);

        $textStyle = "capitalize";
        $cssManagement->editStyle($text, $textStyle);
        $this->assertSame($cssManagement->spyStyle, true);
        
        $textColor = "bold";
        $cssManagement->editColor($text, $textColor);
        $this->assertSame($cssManagement->spyColor, true);
    }

    public function testImaginaryServiceSuccsessfullConnection(): void
    {
        $imaginary = new ImaginaryService();
        $this->assertSame($imaginary->connect(), 'Connected');
    }

    public function testImaginaryServiceFailureConnection(): void
    {
        $imaginary = new ImaginaryService();
        $imaginary->connect();
        $this->expectException(ConnectionImaginaryException::class);
    }

    public function testDisconnectionFromImaginary(): void
    {
        $imaginary = new ImaginaryService();
        $this->assertSame($imaginary->disconnect(), 'Disconnected');
    }

    public function testResizeImageFailure(): void
    {
        $imaginary = new ImaginaryService();
        $file = new DummyImaginaryFile();
        $hight = 50;
        $width = 50;
        $imaginary->resizeImage($file, $hight, $width);
        $this->expectException(DimensionErrorException::class);
    }

    public function testResizeImageSuccessfull(): void
    {
        $imaginary = new ImaginaryService();
        $file = new DummyImaginaryFile();
        $hight = 150;
        $width = 150;
        $imaginary->resizeImage($file, $hight, $width);
        $this->assertSame($imaginary->spyResize, true);
        $this->assertEquals($file->getHight(), $hight);
        $this->assertEquals($file->getWidth(), $width);
    }


    // public function testConnectionToGithub(): void
    // {
    //     $service = new GitHubService();
    //     $service->connectToGithub();
    //     $this->assertSame($service->spy, true);
    // }

    // public function testDisconnectionFromGithub(): void
    // {
    //     $service = new GitHubService();
    //     $this->assertSame($service->disconnectFromGithub(), 'Disconnected');
    // }

    // public function testIndexCreateClientHubspot(): void
    // {
    //     $client = static::createClient();
    //     $client->request('GET', '/create-client-hubspot/colmar/colmar@colmar.fr');
    //     $this->assertSame($client->getResponse()->getContent(), 'Creating hubspot client for colmar colmar@colmar.fr');
    // }

    // public function testConnectionToHubspot(): void
    // {
    //     $service = new DummyHubspotService();
    //     $service->connectToHubspot();
    //     $this->assertSame($service->spyconnect, true);
    // }

    // public function testDisconnectionFromHubspot(): void
    // {
    //     $service = new DummyHubspotService();
    //     $this->assertSame($service->disconnectFromHubspot(), 'Disconnected');
    // }

    // public function testCreateClientHubspot(): void
    // {
    //     $dummyDataBase = new DummyDataBaseManagement();
    //     $clientName = 'Colmar';
    //     $clientMail = 'colmar@mail.fr';
    //     $service = new DummyHubspotService();
    //     $service->createClient($dummyDataBase->clientToAdd($clientName, $clientMail));
    //     $this->assertSame($service->spycreate, true);
    // }

    // public int $client_id=0;

    // public function testPennyLaneServiceCreate(): void
    // {
    //     $client = new DummyClient();
    //     $clientAirtable = $client->getAirTableClient();

    //     $pennylane = new PennyLaneService();
    //     $this->client_id = $pennylane->create($clientAirtable);
    //     $this->assertNotNull($this->client_id, "Client_id error");
    //     $this->getExpectedExceptionMessage("Client yet created");
    //     $this->getExpectedExceptionMessage("Authentification error");
    // }

    // public function testPennyLaneServiceSubscribe(): void
    // {
    //     $pennylane = new PennyLaneService();
    //     $subscribe = $pennylane->subscribe($this->client_id);
    //     $this->assertTrue($subscribe, "Subscription error");
    //     $this->getExpectedExceptionMessage("Authentification error");

    // }

}
