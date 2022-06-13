<?php
namespace App\Services;

use App\Interfaces\DataBaseManagementInterface;
use Yoanbernabeu\AirtableClientBundle\AirtableClientInterface;

class DataBaseManagement implements DataBaseManagementInterface {
    
    private $airtable;

    public function __construct(AirtableClientInterface  $airtable)
    {
        $this->airtable = $airtable;
    }

    public function fetchByCityName(string $cityName) : array{
        $clientRecords = $this->airtable->findBy('Client', 'CityName', $cityName);
        foreach($clientRecords as $record) {
            $client = $record->getFields();
        }
         return $client;
    }
    
    public function getClientList () : array{
        $clientRecords = $this->airtable->findAll('Client');
        return $clientRecords;
    }

    public function persist(Customer $customer){
        
    }
}

?>


// use App\Interfaces\DataBaseManagementInterface;

// class DataBaseManagement implements DataBaseManagementInterface {

//     public function fetchData(int $clientId) : array {
//         $data = array(
//             'cityName' => 'Mulhouse' , 
//             'email' => 'mulhouse@mail.fr' ,
//             'title' => [
//                 'font' => 'Open sans', 
//                 'color' =>'blue', 
//                 'style' => [
//                     'text-transform' => 'italic', 
//                     'font-weight' => 'bold', 
//                     'font-style' => 'capitalize'
//                 ]
//             ], 
//             'paragraph' => [
//                 'font' => 'Open sans', 
//                 'color' =>'black', 
//                 'style' => [
//                     'text-transform' => 'normal', 
//                     'font-weight' => 'normal', 
//                     'font-style' => 'normal'
//                 ]
//             ],
//             'files' => [
//                 'logo' =>
//                     ['name' => 'file1.jpg', 'width' => '100', 'height' => '120', 'extension' => 'jpg'], 
//                 'background' => 
//                     ['name' => 'file2.png', 'width' => '110', 'height' => '150', 'extension' => 'jpeg']
//             ]
//         );
//         return $data;
//     }

//     public function persist(){
        
//     }
// }

// ?>