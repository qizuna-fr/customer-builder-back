<?php

namespace App\Interfaces;

interface PennyLaneServiceInterface
{
    public function create(array $client): int;
    public function subscribe($client_id): bool;
    public function PennyLaneAuthentificate(): bool;

}