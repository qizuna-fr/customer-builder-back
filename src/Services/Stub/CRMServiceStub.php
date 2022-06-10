<?php
namespace App\Services\Stub;

use App\Exceptions\ConnectionCRMException;
use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class CRMServiceStub implements CRMServiceInterface {

    public bool $spyCheckIfClientExist = false;

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
            $this->checkConnectedBeforeVerifyingIfClientExist();

            //code
        }
        return false;
    }

    public function createCustomer(CustomerInterface $customer){
        if ($this->spyCheckIfClientExist) {
            
            //code
        }
        if (!$this->customerExist($customer)) 
        {
            $this->spyCreate = true;
            //code
        }
        else throw new Exception("Customer already exist !");
    }

    public function checkConnectedBeforeVerifyingIfClientExist() : bool{
        $this->spyCheckIfClientExist = true;
        return $this->spyCheckIfClientExist;
    }
}

?>