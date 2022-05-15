<?php
namespace App\Services;

use App\Interfaces\ClientInterface;

class Client implements ClientInterface {

    public function getGithubClient() : array {
        return [];
    }
}

?>