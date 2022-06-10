<?php

namespace App\Interfaces;

interface ClientFactoryInterface
{
    public static function createCustomer(string $type, array $data): CustomerInterface;
}

?>