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
        $dataClientParagraphStyle = [];
        $dataClientTitleStyle = [];
        $dataClientFiles = [];
        $paragraphStyle = [];
        $titleStyle = [];
        $paragraphFont = "";
        $titleFont = "";
        $paragraphColor = "";
        $titleColor = "";
        foreach($dataClientRecords as $record) {
            $dataClient = $record->getFields();
            echo $dataClient['VariableName'];
            if ($dataClient['VariableName'] == 'StyleEcritureParagraphes') $paragraphStyle = explode(" ", $dataClient['Choices']);
            if ($dataClient['VariableName'] == 'StyleEcritureTitre') $titleStyle = explode(" ", $dataClient['Choices']);
            if ($dataClient['VariableName'] == 'PoliceParagraphe') $paragraphFont = $dataClient['Choices'];
            if ($dataClient['VariableName'] == 'PoliceTitre') $titleFont = $dataClient['Choices'];
            if ($dataClient['VariableName'] == 'CouleurParagraphes') $paragraphColor = $dataClient['Choices'];
            if ($dataClient['VariableName'] == 'CouleurTitlre') $titleColor = $dataClient['Choices'];
            if ($dataClient['VariableName'] == 'LogoCommune') $file = $dataClient['Choices'];
        }
        $dataClientParagraphStyle = [
            'font' => $paragraphFont, 
            'color' => $paragraphColor,
            'text-transform' => $paragraphStyle[0],
            'font-weight' => $paragraphStyle[1],
            'font-style' => $paragraphStyle[2]
        ];
        $dataClientTitleStyle = [
            'font' => $titleFont, 
            'color' => $titleColor,
            'text-transform' => $titleStyle[0],
            'font-weight' => $titleStyle[1],
            'font-style' => $titleStyle[2]
        ];
        $dataClientFiles = [
            'name' => $file
        ];
        $airtableClient = new Customer($client['Id-Client'], $client['CityName'], $client['Email'], $dataClientTitleStyle, $dataClientParagraphStyle, $dataClientFiles);
        return $airtableClient;
    }
    
    // public function fetchByClientID (int $clientId) : Customer {
    // }

    public function persist(){
        
    }
}

?>