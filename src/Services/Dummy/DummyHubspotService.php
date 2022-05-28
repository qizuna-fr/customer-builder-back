<?php
namespace App\Services\Dummy;

use App\Interfaces\HubspotServiceInterface;
use Exception;

class DummyHubspotService implements HubspotServiceInterface {

    public bool $spyconnect = false;

    public bool $spycreate = false;

    public bool $exist = false;

    private function ping(){
        $this->spyconnect = true;
    }

    public function connectToHubspot() {
        $this->ping();
        if ($this->spyconnect) {
            return ('Connected');
        }
        else throw new Exception("error");
    }

    public function disconnectFromHubspot() {
        return ('Disconnected');
    }

    public function getHubspotClientList() : array {
        $clientList = ['Mulhouse', 'Cernay', 'Colmar'];
        return $clientList;
    }

    public function exist($client) {
        $clientList = $this->getHubspotClientList();
        if (in_array($client['name'], $clientList)) $this->exist = true;
    }

    public function createClient($client){
        if (!$this->exist) $this->spycreate = true;
    }
    
}

?>