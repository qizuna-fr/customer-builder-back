<?php

namespace App\Tests;

use App\Services\Dummy\DummyDataBaseManagement;
use App\Services\Dummy\DummyGitHubService;
use App\Services\Dummy\DummyFormattingText;
use App\Services\Dummy\DummyImaginaryService;
use App\Services\Dummy\DummyTextCSSManagement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ServicesTest extends WebTestCase
{
    public function testFormatCityName(): void
    {
        $client = static::createClient();
        $client->request('GET', '/format-city-name');
        $this->assertSame($client->getResponse()->getStatusCode(), 200);
    }

    public function testDefineTitleStyle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/edit/title/style-and-font');
        $this->assertSame($client->getResponse()->getContent(), "Editing title style controller");
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

    public function testFormattingText(): void
    {
        $formattingText = new DummyFormattingText();
        $text = "Hello Word";
        $formattedText = $formattingText->deleteSpace($formattingText->lowerCase($text));
        $this->assertSame($formattedText, "hello-word");
    }

    public function testTextCSSManagement(): void
    {
        $textManagement = new DummyTextCSSManagement();
        $textFont = "Open Sans";
        $this->assertSame($textManagement->editTextFont($textFont), true);
        $textStyle = "capitalize";
        $this->assertSame($textManagement->editTextStyle($textStyle), true);
        $textColor = "bold";
        $this->assertSame($textManagement->editTextColor($textColor), true);
    }

    public function testResizeImage(): void
    {
        $service = new DummyImaginaryService();
        $file = "fileName";
        $higth = 120;
        $width = 100;
        $this->assertSame($service->resizeImage($file, $width, $higth), 'fileName 100 120');
    }
    
    public function testConvertImage(): void
    {
        $service = new DummyImaginaryService();
        $file = "fileName";
        $newTyme = "jpg";
        $this->assertSame($service->convertFile($file, $newTyme), 'fileName.jpg');
    }
}
