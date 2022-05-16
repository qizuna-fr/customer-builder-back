<?php

namespace App\Interfaces;

interface ClientInterface {

    public function getGithubClient() : array;

    public function getImaginaryClient() : array;

}

?>