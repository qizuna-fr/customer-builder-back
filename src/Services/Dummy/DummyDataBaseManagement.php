<?php
namespace App\Services\Dummy;

use App\Interfaces\DataBaseManagementInterface;

class DummyDataBaseManagement implements DataBaseManagementInterface {

    public function fetchDataFromDataBase($ClientName) :array {
        $data = array(
            'cityName' => 'Mulhouse' , 
            'titleFont' => 'titleFont', 
            'titleColor' => 'titleColor', 
            'titleStyle' => 'titleStyle',
            'paragraphFont' => 'paragraphFont', 
            'paragraphColor' => 'paragraphColor',
            'paragraphStyle' => 'paragraphStyle',
            'clientFiles' => ['clientLogo' => 'file1', 'clientBackground' => 'file2']

        );
        return $data;
    }

    public function getClient(): array {
        $client = array('name' => 'Colmar', 'mail' => 'colmar@mail.fr');
        return $client;
    }

    public function clientToAdd($name, $mail) : array {
        $client = array('name' => $name, 'mail' => $mail);
        return $client;
    }
}

?>