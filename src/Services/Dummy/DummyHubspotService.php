<?php
namespace App\Services\Dummy;

use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class DummyCRMService implements CRMServiceInterface {

    public bool $spyconnect = false;

    public bool $spycreate = false;

    public bool $exist = false;

    private function ping(){
        $this->spyconnect = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spyconnect) {
            return ('Connected');
        }
        else throw new Exception("error");
    }

    public function disconnect() {
        return ('Disconnected');
    }

    public function getCustomerList() : array {
        $clientList = ['Mulhouse', 'Cernay', 'Colmar'];
        return $clientList;
    }

    public function exist($client) {
        $clientList = $this->getCustomerList();
        if (in_array($client['name'], $clientList)) $this->exist = true;
    }

    public function createCustomer(CustomerInterface $client){
        if (!$this->exist) $this->spycreate = true;
    }
    
}

?>