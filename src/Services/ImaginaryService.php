<?php
namespace App\Services;

use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class ImaginaryService implements ImaginaryServiceInterface {

    public bool $spy = false;

    private function ping(){
        $this->spy = true;
    }

    public function connectToImaginary() {
        $this->ping();
        if ($this->spy) return ('Connected');
        else throw new Exception("error");
    }

    public function disconnectFromImaginary() {
        return('Disconnected');
    }

    public function resizeImage($file, int $width, int $hight){
        if ($hight < 100 || $width < 100) throw new Exception("image dimensions should be > 100 px");
        //code
    }

    public function convertFile($file, $newType){
        //code
    }

}

?>
