<?php

namespace App\Interfaces;

interface ImaginaryServiceInterface {
    
    public function connectToImaginary();

    public function disconnectFromImaginary();

    public function resizeImage($file, int $width, int $hight);

    public function convertFile($file, $newType);

}

?>