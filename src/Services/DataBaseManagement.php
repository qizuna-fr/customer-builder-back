<?php
namespace App\Services;

use App\Interfaces\CustomerInterface;
use App\Interfaces\DataBaseManagementInterface;

class DataBaseManagement implements DataBaseManagementInterface {

    public function fetchData(CustomerInterface $customer) :array {

        return [];
    }

    public function persistData(CustomerInterface $customer) {
        
    }
}

?>