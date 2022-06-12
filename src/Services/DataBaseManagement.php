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