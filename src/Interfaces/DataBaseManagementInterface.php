<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchData(CustomerInterface $customer) : array;

    public function persistData(CustomerInterface $customer);

}

?>