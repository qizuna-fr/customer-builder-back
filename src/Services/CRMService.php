<?php
namespace App\Services;

use App\Interfaces\CRMServiceInterface;
use App\Interfaces\CustomerInterface;

class CRMService implements CRMServiceInterface {

    public function ping(){
    }

    public function connect() {
    }

    public function disconnect() {
        // code
    }

    public function customerExist(CustomerInterface $customer) : bool {
        //code
        return false;
    }

    public function createCustomer(CustomerInterface $customer){

    }

    public function checkExist() : bool{
        return true;
    }
}

?>