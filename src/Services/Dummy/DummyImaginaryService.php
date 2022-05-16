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

    public function resizeImage($file, int $width, int $hight): string{
        if ($hight < 100 || $width < 100) throw new Exception("image dimensions should be > 150 px");
        $resizedFile = $file.' '.$width.' '.$hight;
        return $resizedFile;
    }

    public function convertFile($file, $newType): string{
        $convertedFile = $file.'.'.$newType;
        return $convertedFile;
    }

}

?>
