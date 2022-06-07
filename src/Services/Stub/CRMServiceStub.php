<?php
namespace App\Services\Stub;

use App\Exceptions\ConnectionCRMException;
use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class CRMServiceStub implements CRMServiceInterface {

    public bool $spyCheckExist = false;

    public bool $spyExist = false;

    public bool $spyConnect =false;

    public bool $spyCreate =false;

    public function ping(){
        $this->spyConnect = true;
    }

    public function connect() {
        $this->ping();
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
            $this->checkExist();

            //code
        }
        else throw new Exception('You should connect to CRM first !');
        return false;
    }

    public function createCustomer(CustomerInterface $customer){
        if ($this->spyCheckExist) {
            $this->spyCreate = true;

            //code
        }
        if (!$this->customerExist($customer)) 
        {
            //code
        }
        else throw new Exception("Customer already exist !");
    }

    public function checkExist() : bool{
        $this->spyCheckExist = true;
        return $this->spyCheckExist;
    }
}

?>