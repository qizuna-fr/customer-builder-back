<?php

namespace App\Interfaces;

interface PennyLaneImplementationInterface{

    public function subscribeImplementation($client_id): bool;

    public function authentificateImplementation(): bool;
 
    public function createImplementation($client): ?int;
 

}

?>