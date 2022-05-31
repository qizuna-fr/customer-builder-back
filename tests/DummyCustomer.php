<?php
namespace App\Tests;

use App\Interfaces\CustomerInterface;

class DummyCustomer implements CustomerInterface {
    
    public function getId() : int {

        return 1;
    }

    public function getName() : string {

        return "Mulhouse";
    }

    public function getEmail(): string {

        return "mulhouse@mail.fr";
    }

}

?>