<?php
namespace App\Services\Dummy;

use App\Interfaces\ClientInterface;

class DummyClient implements ClientInterface {

    public function getClientName(): string
    {
        return "Mulhouse";
    }

    public function getClientEmail(): string
    {
        return "mail@mail.fr";
    }
    
}

?>