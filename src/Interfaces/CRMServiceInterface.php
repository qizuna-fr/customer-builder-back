<?php

namespace App\Interfaces;

interface CRMServiceInterface {

    public function ping();
    
    public function connect();

    public function disconnect();

    public function customerExist(CustomerInterface $customer) : bool;

    public function createCustomer(customerInterface $customer); 

    public function checkExist() : bool;
}

?>