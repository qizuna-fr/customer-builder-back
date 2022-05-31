<?php
namespace App\Services;

use App\Interfaces\CustomerInterface;

class Customer implements CustomerInterface {

    public function getId() : int {

        return 0;
    }

    public function getName() : string {

        return "";
    }

    public function getEmail(): string {

        return "";
    }

    public function hasCRM() : bool{
        return false;
    }

    // public function getData() :array {
        
    //     return [];
    // }

    // public function setData(array $customerData){
        
    // }
}

?>