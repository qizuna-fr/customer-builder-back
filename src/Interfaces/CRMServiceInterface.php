<?php

namespace App\Interfaces;

interface CRMServiceInterface {
    
    public function connect();

    public function disconnect();

    public function getCustomerList() : array;

    public function createCustomer(customerInterface $customer); 

}

?>