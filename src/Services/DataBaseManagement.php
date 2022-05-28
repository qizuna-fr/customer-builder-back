<?php
namespace App\Services;

use App\Interfaces\ClientInterface;
use App\Interfaces\DataBaseManagementInterface;

class DataBaseManagement implements DataBaseManagementInterface {

    public function fetchDataFromDataBase($ClientName) :array {

        return [];
    }

    public function getClient() : array {
        return [];
    }

    public function clientToAdd($name, $mail) : array{
        return [];
    }

    public function updateDataBase($variable, $value){
        
    }
}

?>