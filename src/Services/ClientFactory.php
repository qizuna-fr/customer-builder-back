<?php

namespace App\Services;

use App\Interfaces\ClientFactoryInterface;
use App\Interfaces\CustomerInterface;

abstract class ClientFactory implements ClientFactoryInterface {

    public static function createCustomer(string $type, array $data): CustomerInterface {
        switch($type) {
            case 'data_base' :
                return new Customer($data['cityName'],$data['mail'],$data['data']);
            case 'crm' :
                return new CRMCustomer($data['cityName'],$data['mail'],$data['data']);
        }
    }

}

?>