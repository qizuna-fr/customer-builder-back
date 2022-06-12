<?php

namespace App\Interfaces;

use App\Services\Customer;

interface DataBaseManagementInterface {

    // public function fetchByClientID(int $clientId) : Customer;

    public function fetchByCityName(string $cityName) : array;

    public function getClientList () : array ;

    public function persist(Customer $customer);

}

?>