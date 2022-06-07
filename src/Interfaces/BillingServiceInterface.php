<?php

namespace App\Interfaces;

interface BillingServiceInterface
{
    public function connect(): bool;
    public function disconnect(): bool;
    public function create(CustomerInterface $client): bool;
    public function subscribe($client_id): bool;

    public function isThisCustomerYetCreated(CustomerInterface $client);
    public function HasCustomerYetSubscribe(CustomerInterface $client);

}