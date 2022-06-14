<?php

namespace App\Interfaces;

interface ImaginaryServiceInterface {

    public function ping();
    
    public function connect();

    public function disconnect();

    public function resizeImage(string $url, int $height, int $width) ;

    public function convertFile(string $url, $newType);

}

?>