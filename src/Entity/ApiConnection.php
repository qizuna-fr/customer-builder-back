<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpClient\HttpClient;

class ApiConnection
{
    private $client;

    public function github()
    {
    }

    public function billing()
    {
        $billingurl = $_ENV['BILLINGSERVICEURL'];

        $parameters=[];
        $cookies=[];
        $file=[];
        $server=[];

        $contenu=["content","content1"];

        $request = new Request();
        $response= $request->create($billingurl, 'POST',$parameters, $cookies, $file, $server, $contenu);
        
        return $response;
        // dump($response);

    }
    public function imaginary()
    {
    }
}
