<?php
namespace App\Services;

use App\Exceptions\ConnectionImaginaryException;
use App\Interfaces\ImaginaryFileInterface;
use App\Interfaces\ImaginaryServiceInterface;
use Exception;

class ImaginaryService implements ImaginaryServiceInterface {

    public bool $spyConvert = false;

    public function ping(){
    }

    public function connect() {
    }

    public function disconnect() {
    }

    public function resizeImage(string $url, int $height , int $width){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/resize?url='.$url.'&width='.$width.'&height='.$height);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: image/*';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        
        return $result;
        
    }

    public function convertFile(string $url, $newType){

    }

}

?>
