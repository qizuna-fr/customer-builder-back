<?php
namespace App\Tests;

use App\Interfaces\CustomerInterface;
use App\Interfaces\DataBaseManagementInterface;

class DummyDataBaseManagement implements DataBaseManagementInterface {

    public function fetchCustomerData(CustomerInterface $customer) : CustomerInterface {
        
        return $customer;
    }

    public function persist(CustomerInterface $customer){
        
    }
}

?>