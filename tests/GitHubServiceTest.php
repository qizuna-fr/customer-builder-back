<?php

namespace App\Tests;

use App\Services\Dummy\DummyGitHubService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GitHubServiceTest extends WebTestCase
{
    public function testConnectionToGithub(): void
    {
        $service = new DummyGitHubService();
        $this->assertSame($service->connectToGithub(), 'Connected');
    }
}
