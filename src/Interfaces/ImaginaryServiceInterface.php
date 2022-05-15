<?php

namespace App\Interfaces;

interface ImaginaryServiceInterface {
    
    public function connectToImaginary();

    public function disconnectFromImaginary();

    public function resizeImage($file);

    public function convertFile($file);

}

?>