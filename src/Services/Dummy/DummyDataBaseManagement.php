<?php
namespace App\Services\Dummy;

use App\Interfaces\CustomerInterface;
use App\Interfaces\DataBaseManagementInterface;

class DummyDataBaseManagement implements DataBaseManagementInterface {

    public function fetchData(CustomerInterface $customer) :array {
        $data = array(
            'cityName' => 'Mulhouse' , 
            'titleFont' => 'titleFont', 
            'titleColor' => 'titleColor', 
            'titleStyle' => 'titleStyle',
            'paragraphFont' => 'paragraphFont', 
            'paragraphColor' => 'paragraphColor',
            'paragraphStyle' => 'paragraphStyle',
            'clientFiles' => [
                'clientLogo' =>
                    ['name' => 'file1.jpg', 'width' => '100', 'hight' => '120', 'extension' => 'jpg'], 
                'clientBackground' => 
                    ['name' => 'file2.png', 'width' => '110', 'hight' => '150', 'extension' => 'jpeg']
            ]
        );
        return $data;
    }

    public function persistData(CustomerInterface $customer){
        
    }
}

?>