<?php
namespace App\Services;

use App\Exceptions\ConnectionCRMException;
use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class CRMService implements CRMServiceInterface {


    public bool $spyExist = false;

    public bool $spyConnect =false;

    public bool $spyCreate =false;

    public function ping(){
        $this->spyConnect = true;
    }

    public function connect() {
        if ($this->spyConnect) {
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
        if ($this->spyConnect) {
            $this->spyExist = true;

            //code
        }
        else throw new Exception('You should connect to CRM first !');
        return false;
    }

    public function createCustomer(CustomerInterface $customer){
        if ($this->spyExist) {
            $this->spyCreate = true;

            //code
        }
        else throw new Exception("Customer already exist !");
    }
}

?>