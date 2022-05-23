<?php
namespace App\Services;

use App\Interfaces\DataBaseManagementInterface;

class DataBaseManagement implements DataBaseManagementInterface {

    public function fetchDataFromDataBase($ClientName) :array {
        $data = array(
            'cityName' => 'cityName' , 
            'titleFont' => 'titleFont', 
            'titleColor' => 'titleColor', 
            'titleStyle' => 'titleStyle',
            'paragraphFont' => 'paragraphFont', 
            'paragraphColor' => 'paragraphColor',
            'paragraphStyle' => 'paragraphStyle'
        );
        return $data;
    }
}

?>