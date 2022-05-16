<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchDataFromDataBase($clientName) : array;

}

?>