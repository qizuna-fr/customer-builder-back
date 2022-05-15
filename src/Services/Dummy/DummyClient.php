<?php
namespace App\Services\Dummy;

use App\Interfaces\ClientInterface;

class DummyClient implements ClientInterface {

    public function getGithubClient() :array {
        $client = [
            'name' => 'clientName' , 
            'email' => 'clientEmail', 
            'cityName' => 'clientCityName', 
            'password' => 'clientPassword'
        ];
            
        return $client;
    }

    public function getImaginaryClient() : array {
        $client = [
            'name' => 'clientName' , 
            'email' => 'clientEmail', 
            'cityName' => 'clientCityName', 
            'password' => 'clientPassword'
        ];
        return $client;
    }
}

?>