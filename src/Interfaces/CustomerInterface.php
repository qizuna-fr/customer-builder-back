<?php

namespace App\Interfaces;

interface CustomerInterface {

    public function getId() : int;

    public function setId(int $id) ;

    public function getName() : string;

    public function setName(string $name);

    public function getEmail() : string;

    public function setEmail(string $mail);

    public function getData() : array;

    public function setData(array $customerData);

}

?>