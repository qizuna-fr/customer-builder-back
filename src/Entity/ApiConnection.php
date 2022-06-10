<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\Request;
// use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class ApiConnection
{

    public function billing()
    {
        $billingurl = $_ENV['BILLINGSERVICEURL'];

        $httpClient = HttpClient::create();
        // $response = $httpClient->request('GET', "http://127.0.0.1:8000/billing/48");

        $response = $httpClient->request('GET', "https://jsonplaceholder.typicode.com/users");

        echo ($response->getContent());

        $statusCode = $response->getStatusCode();
        echo ($statusCode);

    }

    public function github()
    {
    }

    public function imaginary()
    {
    }
}
