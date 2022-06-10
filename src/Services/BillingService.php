<?php

namespace App\Services;

use App\Interfaces\BillingServiceInterface;
use App\Interfaces\CustomerInterface;
use App\Tests\DummyDataBaseManagement;
use Exception;

class BillingService implements BillingServiceInterface
{

    public function connect(): bool
    {
        // throw new Exception("billing connect error...");
        return true;
    }

    public function Disconnect(): bool
    {
        // throw new Exception("billing disconnect error...");
        return true;
    }

    public function create(CustomerInterface $client): bool
    {

        if ($this->isThisCustomerYetCreated($client))
            throw new Exception("Client yet created..");

        return true;
    }

    public function subscribe($client_id): bool
    {
        return true;
    }


    public function isThisCustomerYetCreated(CustomerInterface $client): bool
    {
        return false;
    }

    public function hasCustomerYetSubscribe(CustomerInterface $client): bool
    {
        return true;
    }
}
