<?php

namespace App\Interfaces;

interface DataBaseManagementInterface {

    public function fetchData(ClientInterface $client) : ClientInterface;

    public function persistData(ClientInterface $client);

}

?>