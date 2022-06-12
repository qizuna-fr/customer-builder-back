<?php

namespace App\Interfaces;

interface CustomerInterface {

    public function getId() : int;

    public function setId(int $id) ;

    public function getName() : string;

    public function setName(string $name);

    public function getEmail() : string;

    public function setEmail(string $mail);

    public function getTitleStyle() : array;

    public function setTitleStyle(array $titleStyle);

    public function setParagraphStyle(array $paragraphStyle);

    public function getParagraphStyle() : array;

    public function setFiles(array $files);

    public function getFiles() : array;


}

?>