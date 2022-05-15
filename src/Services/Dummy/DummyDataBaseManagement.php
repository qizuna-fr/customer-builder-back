<?php
namespace App\Services\Dummy;

use App\Interfaces\DataBaseManagementInterface;

class DummyDataBaseManagement implements DataBaseManagementInterface {

    public function fetchDataFromDataBase() :array {
        $data = [
            'cityName' => 'cityName' , 
            'titleFont' => 'titleFont', 
            'titleColor' => 'titleColor', 
            'titleStyle' => 'titleStyle',
            'paragraphFont' => 'paragraphFont', 
            'paragraphColor' => 'paragraphColor',
            'paragraphStyle' => 'paragraphStyle'
        ];
            
        return $data;
    }

}

?>