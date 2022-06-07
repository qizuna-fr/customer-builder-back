<?php

namespace App\Services\Dummy;

use App\Interfaces\BillingServiceInterface;
use App\Interfaces\CustomerInterface;
use Exception;

class DummyBillingService implements BillingServiceInterface
{
    public function connect(): bool
    {
        return true;
    }

    public function Disconnect(): bool
    {
        return true;
    }

    public function create(CustomerInterface $client): bool
    {

        return true;
    }

    public function subscribe($client_id): bool
    {
        return true;
    }

    public function isThisCustomerYetCreated(CustomerInterface $client): bool
    {
        return true;
    }

    public function hasCustomerYetSubscribe(CustomerInterface $client): bool
    {
        return true;
    }


}
