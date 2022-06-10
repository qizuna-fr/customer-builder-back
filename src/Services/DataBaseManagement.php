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

    public function fetchByCityName(string $cityName) : Customer{
        // $clientRecords = $this->airtable->findAll('Client');
        $clientRecords = $this->airtable->findBy('Client', 'CityName', $cityName);
        foreach($clientRecords as $record) {
            $client = $record->getFields();
        }
        $clientId = $client['Id-Client'];
        $dataClientRecords = $this->airtable->findBy('Data', 'Client', $clientId);
        $dataClientFromAirtable = [];
        foreach($dataClientRecords as $record) {
            $dataClient = $record->getFields();
            array_push($dataClientFromAirtable, [$dataClient['VariableName'] => $dataClient['Choices']]);
        }
        $airtableClient = new Customer($client['Id-Client'], $client['CityName'], $client['Email'], $dataClientFromAirtable);
        return $airtableClient;
    }
    
    // public function fetchByClientID (int $clientId) : Customer {
    // }

    public function persist(){
        
    }
}

?>