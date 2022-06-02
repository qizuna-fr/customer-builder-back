<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchData(int $clientId) : array;

    public function persist();

}

?>