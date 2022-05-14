<?php

namespace App\Tests;

use App\Services\Dummy\DummyGitHubService;
use App\Services\DummyFormattingText;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GitHubServiceTest extends WebTestCase
{
    public function testGitHubContoller(): void
    {
        $client = static::createClient();
        $client->request('GET', '/formatted/city-name');
        $this->assertSame($client->getResponse()->getStatusCode(), 200);
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

    public function testFetchDataFromDataBase(): void
    {
        $service = new DummyGitHubService();
        $datas = $service->fetchDataFromDataBase();
        $this->assertNotEmpty($datas);
    }

    public function testFormattingText(): void
    {
        $formattingText = new DummyFormattingText();
        $text = "Hello Word";
        $formattedText = $formattingText->deleteSpace($formattingText->lowerCase($text));
        $this->assertSame($formattedText, "hello_word");
    }
}
