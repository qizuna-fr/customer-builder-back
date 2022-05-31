<?php
namespace App\Services;

use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class CRMService implements CRMServiceInterface {

    public bool $spyconnect = false;

    public bool $spycreate = false;

    public bool $exist;

    private function ping(){
        // code
        $this->spyconnect = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spyconnect) {
            // code
            return ('Connected');
        }
        else throw new Exception("error");
    }

    public function disconnect() {
        // code
        return ('Disconnected');
    }

    public function getCustomerList() : array {
        // code
        $clientList = [];
        return $clientList;
    }

    public function exist($client, $clientList) {
        if (in_array($client, $clientList)) $this->exist = true;
        else $this->exist = false;
    }

    public function createCustomer(CustomerInterface $customer){
        // code
        if ($this->exist) $this->spyconnect = true;
    }
}

?>