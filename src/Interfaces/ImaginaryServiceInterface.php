<?php

namespace App\Interfaces;

interface ImaginaryServiceInterface {

    public function ping();
    
    public function connect();

    public function disconnect();

    public function resizeImage(ImaginaryFileInterface $file, int $height, int $width) ;

    public function convertFile(ImaginaryFileInterface $file, $newType);

}

?>