<?php

namespace App\Interfaces;

interface CRMCustomerInterface {

    public function id() : int;

    public function getName() : string;

    public function getEmail() : string;

    public function getData() : array;

    public function setData(array $customerData);

}

?>