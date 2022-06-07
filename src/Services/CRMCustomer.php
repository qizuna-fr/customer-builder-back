<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;

class CRMCustomer implements CustomerInterface {

    public function __construct(private int $name, private string $mail, private array $data)
    {
        
    }

    public function Getid() : int {

        return 1;
    }

    public function getName() : string {

        return $this->name;
    }

    public function setName(string $name) {

        $this->name = $name;
    }

    public function setEmail(string $mail) {
        $this->mail = $mail;
    }

    public function getEmail(): string {

        return $this->mail;
    }

    public function getData() : array{
        return $this->data;
    }

    public function setData(array $data){
        
    }
}

?>