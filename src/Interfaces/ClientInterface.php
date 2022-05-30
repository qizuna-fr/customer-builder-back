<?php

namespace App\Interfaces;

interface ClientInterface {

    public function getClientName() : string;

    public function getClientEmail() : string;

    public function getClientData() : array;

    public function setClientData(array $data);

}

?>