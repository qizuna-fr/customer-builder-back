<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;

class Customer implements CustomerInterface {

    private int $id;
    private string $name; 
    private string $mail; 
    private array $data;

    public function __construct(int $id, string $name, string $mail, array $data)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->data = $data;
    }

    public function getId() : int {

        return $this->id;
    }

    public function setId(int $id) {

        $this->id = $id;
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