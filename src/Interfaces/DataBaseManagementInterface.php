<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchCustomer(int $customerId) : CustomerInterface;

    public function fetchCustomerData(CustomerInterface $customer) : array;

    public function persist(CustomerInterface $customer, array $data);

}

?>