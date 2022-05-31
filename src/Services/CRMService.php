<?php
namespace App\Services;

use App\Exceptions\ConnectionCRMException;
use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class CRMService implements CRMServiceInterface {

    private bool $spyconnect = false;

    public bool $exist ;

    public bool $notExist ;

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
        else throw new ConnectionCRMException();
    }

    public function disconnect() {
        // code
        return ('Disconnected');
    }

    public function customerExist(CustomerInterface $customer) : bool {
        if ($customer->hasCRM()) return true; 
        else return false;
    }

    public function createCustomer(CustomerInterface $customer){
        // code
        if (!$this->customerExist($customer)) $this->spyconnect = true;
        else throw new Exception("Customer already exist !");
    }
}

?>