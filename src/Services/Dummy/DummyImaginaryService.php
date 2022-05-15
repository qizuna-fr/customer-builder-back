<?php
namespace App\Services\Dummy;

use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class DummyImaginaryService implements ImaginaryServiceInterface {

    public bool $spy;

    public function connectToImaginary() {
        $status = 200;
        if ($status == 200) return 200;
        else throw new Exception("error");
    }

    public function disconnectFromImaginary() {
        return('Disconnected');
    }

    public function uploadFile(): string{
        $file = "fileName";
        return $file;
    }

    public function resizeImage($file, int $width, int $hight): string{
        $resizedFile = "newFile";
        return $resizedFile;
    }

    public function convertFile($file): string{
        $convertedFile = "newFile";
        return $convertedFile;
    }

}

?>
