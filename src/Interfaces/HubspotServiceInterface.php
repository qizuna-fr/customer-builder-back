<?php

namespace App\Interfaces;

interface CRMServiceInterface {
    
    public function connect();

    public function disconnect();

    public function getClientList() : array;

    public function createClient(ClientInterface $client); 

}

?>