<?php
namespace App\Services\Dummy;

use App\Exceptions\ConnectionImaginaryException;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class DummyImaginaryService implements ImaginaryServiceInterface {

    public bool $spyPing = false;
    public bool $spyResize = false;
    public bool $spyConvert = false;

    public function ping(){
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

    public function resizeImage(string $url, int $height , int $width){
        
        if ($this->connect() == 'Connected') {
            $this->spyResize = true;

            //code
            
            // implementation ??
            // $file->setHeight ($height );
            // $file->setWidth($width);
        }
        else throw new Exception('You should connect to Imaginary first !');
        
    }

    public function convertFile(string $url, $newType){
        if ($this->connect() == 'Connected') {
            $this->spyConvert = true;

            //code
    
            // implementation ??
            // $file->setExtension($newType);
        }
        else throw new Exception('You should connect to Imaginary first !');
    }

}

?>
