<?php
namespace App\Services;

use App\Interfaces\ImaginaryServiceInterface;

class ImaginaryService implements ImaginaryServiceInterface {

    public function connectToImaginary() {
    }

    public function disconnectFromImaginary() {
        
    }

    public function resizeImage($file, int $width, int $hight): string{
        return "";
    }

    public function convertFile($file, $newType): string{
        return "";
    }

}

?>
