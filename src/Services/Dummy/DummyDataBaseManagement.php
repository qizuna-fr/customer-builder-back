<?php
namespace App\Services\Dummy;

use App\Interfaces\DataBaseManagementInterface;
use App\Services\Customer;

class DummyDataBaseManagement  {

    // public function fetchData(int $clientId) : array {
    //     $data = array(
    //         'cityName' => 'Mulhouse' , 
    //         'email' => 'mulhouse@mail.fr' ,
    //         'title' => [
    //             'font' => 'Open sans', 
    //             'color' =>'blue', 
    //             'style' => [
    //                 'text-transform' => 'italic', 
    //                 'font-weight' => 'bold', 
    //                 'font-style' => 'capitalize'
    //             ]
    //         ], 
    //         'paragraph' => [
    //             'font' => 'Open sans', 
    //             'color' =>'black', 
    //             'style' => [
    //                 'text-transform' => 'normal', 
    //                 'font-weight' => 'normal', 
    //                 'font-style' => 'normal'
    //             ]
    //         ],
    //         'files' => [
    //             'logo' =>
    //                 ['name' => 'file1.jpg', 'width' => '100', 'height' => '120', 'extension' => 'jpg'], 
    //             'background' => 
    //                 ['name' => 'file2.png', 'width' => '110', 'height' => '150', 'extension' => 'jpeg']
    //         ]
    //     );
    //     return $data;
    // }

    public function fetchByCityName(string $cityName) {
        // $clientRecords = $this->airtable->findAll('Client');
        // foreach($clientRecords as $record) {
        //     $client = $record->getFields();
        //     // dd($client);
        //     echo $client['Id']."</br>";
        // }
        // return $client;
    }
    
    // public function fetchByClientID (int $clientId) : Customer {
    // }

    public function getClientList () : array{
        return [];
    }


    public function persist(Customer $customer){
        
    }
}

?>