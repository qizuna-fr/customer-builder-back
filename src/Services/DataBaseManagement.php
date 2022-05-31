<?php
namespace App\Services;

use App\Interfaces\CustomerInterface;
use App\Interfaces\DataBaseManagementInterface;

class DataBaseManagement implements DataBaseManagementInterface {

    public function fetchCustomer(int $customerId) : CustomerInterface {
        $customer = new CustomerInterface;
        return $customer;
    }

    public function fetchCustomerData(CustomerInterface $customer) :array {

        return [];
    }

    public function persist(CustomerInterface $customer, array $data) {
        
    }
}

?>