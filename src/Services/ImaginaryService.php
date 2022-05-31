<?php
namespace App\Services;

use App\Exceptions\ConnectionImaginaryException;
use App\Exceptions\DimensionErrorException;
use App\Exceptions\ExtensionErrorException;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class ImaginaryService implements ImaginaryServiceInterface {

    private bool $spyPing = false;
    public bool $spyResize = false;
    public bool $spyConvert = false;

    private function ping(){
        $this->spyPing = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spyPing) return ('Connected');
        else throw new ConnectionImaginaryException();
    }

    public function disconnect() {
        return('Disconnected');
    }

    public function resizeImage(ImaginaryFileInterface $file, int $hight, int $width){
        if ($hight < 100 || $width < 100) throw new DimensionErrorException();
        //code
        $file->setHight($hight);
        $file->setWidth($width);
        $this->spyResize = true;

    }

    public function convertFile(ImaginaryFileInterface $file, $newType){
        $extensions = ['jpg', 'png', 'jpeg'];
        if (!in_array($newType , $extensions)) throw new ExtensionErrorException();
        //code
        $file->setExtension($newType);
        $this->spyConvert = true;

    }

}

?>
