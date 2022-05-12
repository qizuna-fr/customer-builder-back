<?php

use App\Tests\Mock\GitApiMock;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GitApiTest extends WebTestCase
{
    protected function setUp(): void
    {
        $this->gitApi = new GitApiMock();
        if (!isset($this->GitApi))
            throw   new Exception("GitApi object not found");
    }

    public function testGitAuthentification(string $client_id, string $client_secret): void
    {
   
    }
}
