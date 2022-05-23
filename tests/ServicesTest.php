<?php

namespace App\Tests;

use App\Services\Dummy\DummyDataBaseManagement;
use App\Services\Dummy\DummyGitHubService;
use App\Services\Dummy\DummyImaginaryService;
use App\Services\FormattingText;
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
        $service = new DummyImaginaryService();
        $this->assertSame($service->connectToImaginary(), 200);
    }

    public function testDisconnectionFromImaginary(): void
    {
        $service = new DummyImaginaryService();
        $this->assertSame($service->disconnectFromImaginary(), 'Disconnected');
    }



    public function testIndexConvertFile(): void
    {
        $client = static::createClient();
        $client->request('GET', '/convert/clientLogo/jpg');
        $this->assertSame($client->getResponse()->getContent(), "converting file clientLogo to jpg");
    }

    public function testConnectionToGithub(): void
    {
        $service = new DummyGitHubService();
        $this->assertSame($service->connectToGithub(), 200);
    }

    public function testDisconnectionFromGithub(): void
    {
        $service = new DummyGitHubService();
        $this->assertSame($service->disconnectFromGithub(), 'Disconnected');
    }



    public function testCreateBranchGithub(): void
    {
        $service = new DummyGitHubService();
        $branchName = "MaBranche";
        $this->assertSame($service->createBranchGithub($branchName), true);
    }

    public function testCreateRepositoryGithub(): void
    {
        $service = new DummyGitHubService();
        $clientCityName = "CityName";
        $repositoryName = "Repository-name";
        $this->assertSame($service->createRepositoryGithub($repositoryName, $clientCityName), true);
    }

    public function testAddContent(): void
    {
        $service = new DummyGitHubService();
        $content = "";
        $this->assertSame($service->addContent($content), "");
    }

    public function testFetchRepository(): void
    {
        $service = new DummyGitHubService();
        $clientCityName = "CityName";
        $this->assertSame($service->fetchRepository($clientCityName), "CityName-repository");
    }

    public function testFetchBranch(): void
    {
        $service = new DummyGitHubService();
        $branchName = "";
        $this->assertSame($service->fetchBranch($branchName), "");
    }

    public function testAddCommitMessage(): void
    {
        $service = new DummyGitHubService();
        $clientCityName = "cityName";
        $branchName = "ma-branche";
        $message = "message for commit branch";
        $content = "content";
        $this->assertSame($service->addCommitMessage($clientCityName, $branchName, $content, $message), true);
    }

    public function testPushBranchGithub(): void
    {
        $service = new DummyGitHubService();
        $clientCityName = "cityName";
        $branchName = "ma-branche";
        $this->assertSame($service->pushBranchGithub($clientCityName, $branchName), true);
    }

    public function testFetchDataFromDataBase(): void
    {
        $dataBase = new DummyDataBaseManagement();
        $clientName = "clientName";
        $datas = $dataBase->fetchDataFromDataBase($clientName);
        $this->assertNotEmpty($datas);
    }



    public function testResizeImage(): void
    {
        $service = new DummyImaginaryService();
        $file = "fileName";
        $higth = 120;
        $width = 100;
        $this->assertSame($service->resizeImage($file, $width, $higth), 'fileName 100 120');
    }
    
    public function testConvertFile(): void
    {
        $service = new DummyImaginaryService();
        $file = "fileName";
        $newTyme = "jpg";
        $this->assertSame($service->convertFile($file, $newTyme), 'fileName.jpg');
    }

}
