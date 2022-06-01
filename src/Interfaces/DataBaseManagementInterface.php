<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchData(CustomerInterface $customer) : CustomerInterface;

    public function persist(CustomerInterface $customer);

}

?>