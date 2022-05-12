<?php

use App\Controller\ApiDispatcherController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class GitApiTest extends WebTestCase
{
    protected function setUp(): void
    {
        $this->ApiDispatcherController = new  ApiDispatcherController();
        if (!isset($this->ApiDispatcherController ))
            throw   new Exception("Api Dispatcher controller object not found");
    }

    public function testGitAuthentification(string $client_id, string $client_secret): void
    {
   
    }
}
