<?php
namespace App\Services;

use App\Interfaces\ClientInterface;
use App\Interfaces\HubspotServiceInterface;
use Exception;

class HubspotService implements HubspotServiceInterface {

    public bool $spyconnect = false;

    public bool $spycreate = false;

    public bool $exist;

    private function ping(){
        // code
        $this->spyconnect = true;
    }

    public function connectToHubspot() {
        $this->ping();
        if ($this->spyconnect) {
            // code
            return ('Connected');
        }
        else throw new Exception("error");
    }

    public function disconnectFromHubspot() {
        // code
        return ('Disconnected');
    }

    public function getHubspotClientList() : array {
        // code
        $clientList = [];
        return $clientList;
    }

    public function exist($client, $clientList) {
        if (in_array($client, $clientList)) $this->exist = true;
        else $this->exist = false;
    }

    public function createClient($client){
        // code
        if ($this->exist) $this->spyconnect = true;
    }
}

?>