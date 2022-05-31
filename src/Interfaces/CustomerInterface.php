<?php

namespace App\Interfaces;

interface CustomerInterface {

    public function getId() : int;

    public function getName() : string;

    public function getEmail() : string;

    // public function getData() : array;

    // public function setData(array $customerData);

}

?>