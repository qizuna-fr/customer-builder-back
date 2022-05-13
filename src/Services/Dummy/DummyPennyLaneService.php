<?php

namespace App\Services\Dummy;

use App\Interfaces\PennyLaneServiceInterface;


class DummyPennyLaneService implements PennyLaneServiceInterface
{

    public function connect(): bool
    {
        return true;
    }

    public function disconnect(): bool
    {
        return  true;
    }

    public function exist(): bool
    {
        return  true;
    }

    public function subscription(): bool
    {
        return  true;
    }

    public function unsubscription(): bool
    {
        return  true;
    }
    public function create(): bool
    {
        return  true;
    }

    public function delete(): bool
    {
        return  true;
    }

    public function billing(): bool
    {
        return  true;
    }

}

