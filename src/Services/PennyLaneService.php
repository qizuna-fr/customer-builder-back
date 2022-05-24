<?php

namespace App\Services;

use App\Interfaces\PennyLaneServiceInterface;
use App\Services\Dummy\BadPennyLaneImplementation;
use App\Services\Dummy\GoodPennyLaneImplementation;
use Exception;

class PennyLaneService implements PennyLaneServiceInterface
{
    private bool $pennyLaneAuthentified = false;
    private GoodPennyLaneImplementation $implementation;
    // private badPennyLaneImplementation $implementation;

    public function __construct()
    {
        $this->implementation = new GoodPennyLaneImplementation();
        // $this->implementation = new BadPennyLaneImplementation();
    }

    public function create(array $client): int
    {
        echo "creating client... \n ";

        $this->pennyLaneAuthentificate();

        if (!$this->IsClientYetCreated($client))
            return  $this->implementation->createImplementation($client);

        throw new Exception("Client yet created");
    }

    public function subscribe($client_id): bool
    {
        echo "subscribing in progress ...\n";
        $this->pennyLaneAuthentificate();
     
        return $this->implementation->subscribeImplementation($client_id);
    }


    private function isClientYetCreated(array $client): bool
    {
        $database = new DataBaseManagement();
        if ($database->fetchDataFromDataBase($client) == null)
            return false;

        return true;
    }

    public function pennyLaneAuthentificate(): bool
    {
        echo "pennyLane Service Authentificate...\n";

        if ($this->pennyLaneAuthentified)
            return true;

        $this->implementation->authentificateImplementation();
        return true;
    }
}