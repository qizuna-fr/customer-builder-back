<?php

namespace App\Interfaces;

interface HubspotServiceInterface {
    
    public function connectToHubspot();

    public function disconnectFromHubspot();

    public function getHubspotClientList() : array;

    public function createClient($client);

}

?>