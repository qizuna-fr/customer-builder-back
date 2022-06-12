<?php

namespace App\Interfaces;

use App\Services\Customer;

interface DataBaseManagementInterface {

    // public function fetchByClientID(int $clientId) : Customer;

    public function fetchCustomerByCityName(string $cityName) : Customer;

    public function getClientList () : array ;

    public function getClientData ( $id) ;

    public function persist(Customer $customer);

}

?>