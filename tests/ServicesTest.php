<?php

namespace App\Tests;

use App\Services\FormattingText;
use App\Services\GitHubService;
use App\Services\ImaginaryService;
use App\Services\TextCSSManagement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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

}
