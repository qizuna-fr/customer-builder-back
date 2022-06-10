<?php

namespace App\Interfaces;

use App\Services\Customer;

interface DataBaseManagementInterface {

    // public function fetchByClientID(int $clientId) : Customer;

    public function fetchByCityName(string $cityName) : Customer;

    public function persist();

}

?>