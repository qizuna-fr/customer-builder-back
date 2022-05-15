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

    public function resizeImage($file){
        
    }

    public function convertFile($file){
        
    }

}

?>
