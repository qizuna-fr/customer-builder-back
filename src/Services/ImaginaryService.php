<?php
namespace App\Services;

use App\Exceptions\ConnectionImaginaryException;
use App\Exceptions\DimensionErrorException;
use App\Exceptions\ExtensionErrorException;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class ImaginaryService implements ImaginaryServiceInterface {

    public bool $spyPing = false;
    public bool $spyResize = false;
    public bool $spyConvert = false;

    public function ping(){
        $this->spyPing = true;
    }

    public function connect() {
        if ($this->spyPing) return ('Connected');
        else throw new ConnectionImaginaryException(); 
    }

    public function disconnect() {
        return('Disconnected');
    }

    public function resizeImage(ImaginaryFileInterface $file, int $hight, int $width){
        
        if ($this->connect() == 'Connected') {
            $this->spyResize = true;

            //code
            
            // implementation ??
            // $file->setHight($hight);
            // $file->setWidth($width);
        }
        else throw new Exception('You should connect to Imaginary first !');
        
    }

    public function convertFile(ImaginaryFileInterface $file, $newType){
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
