<?php
namespace App\Services;

use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class ImaginaryService implements ImaginaryServiceInterface {

    public bool $spy = false;

    private function ping(){
        $this->spy = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spy) return ('Connected');
        else throw new Exception("error");
    }

    public function disconnect() {
        return('Disconnected');
    }

    public function resizeImage(ImaginaryFileInterface $file, int $width, int $hight){
        if ($hight < 100 || $width < 100) throw new Exception("image dimensions should be > 100 px");
        //code
    }

    public function convertFile(ImaginaryFileInterface $file, $newType){
        //code
    }

}

?>
