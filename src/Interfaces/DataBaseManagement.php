<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchDataFromDataBase($clientName) : array;

    public function getClient() : array;

    public function clientToAdd($name, $mail) : array;

}

?>