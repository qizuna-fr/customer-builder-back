<?php

namespace App\Interfaces;

interface ImaginaryServiceInterface {
    
    public function connect();

    public function disconnect();

    public function resizeImage(ImaginaryFileInterface $file, int $width, int $hight);

    public function convertFile(ImaginaryFileInterface $file, $newType);

}

?>