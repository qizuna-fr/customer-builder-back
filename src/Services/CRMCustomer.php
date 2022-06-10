<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;

class CRMCustomer implements CustomerInterface {

    private int $id;
    private string $name; 
    private string $mail; 
    private array $titleStyle;
    private array $paragraphStyle;
    private array $files;

    public function __construct(int $id, string $name, string $mail, array $titleStyle, array $paragraphStyle, array $files)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->titleStyle = $titleStyle;
        $this->paragraphStyle = $paragraphStyle;
        $this->files = $files;
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

    public function getTitleStyle() : array{
        return $this->titleStyle;
    }

    public function setTitleStyle(array $titleStyle){
        $this->titleStyle = $titleStyle;
    }

    public function setParagraphStyle(array $paragraphStyle){
        $this->paragraphStyle = $paragraphStyle;

    }

    public function getParagraphStyle() : array{
        return $this->paragraphStyle;
    }

    public function setFiles(array $files){
        $this->files = $files;
    }

    public function getFiles() : array{
        return $this->files;
    }
}

?>