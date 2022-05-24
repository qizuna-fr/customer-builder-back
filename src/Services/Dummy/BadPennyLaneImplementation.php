<?php

namespace App\Services\Dummy;

use App\Interfaces\PennyLaneImplementationInterface;
use Exception;

class BadPennyLaneImplementation implements PennyLaneImplementationInterface
{
    public function createImplementation($client): ?int
    {
        return false;
    }

    public function subscribeImplementation($client_id): bool
    {
        return false;
        return false;
    }


    public function authentificateImplementation(): bool
    {
        // return false;
        throw new Exception("Authentification error");

        return false;
    }
}