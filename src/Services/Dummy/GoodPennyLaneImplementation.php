<?php
namespace App\Services\Dummy;

use App\Interfaces\PennyLaneImplementationInterface;
use Exception;

class GoodPennyLaneImplementation implements PennyLaneImplementationInterface
{
    public function subscribeimplementation($client_id): bool
    {
        return true;
    }


    public function authentificateImplementation(): bool
    {
        return true;
    }

    public function createImplementation($client): ?int
    {
        return 2;
    }

}

?>