<?php
namespace App\Services;

use App\Interfaces\DataBaseManagementInterface;
use Yoanbernabeu\AirtableClientBundle\AirtableClientInterface;

class DataBaseManagement implements DataBaseManagementInterface {
    
    public function __construct()
    {
    }

    public function fetchCustomerByCityName(string $cityName) : Customer{
        // $clientRecords = $this->airtable->findBy('Client', 'CityName', $cityName);
        // foreach($clientRecords as $record) {
        //     $client = $record->getFields();
        // }

        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Client?filterByFormula=SEARCH('".$cityName."'%2C+%7BcityName%7D)";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = array(
           "Authorization: Bearer keyWdc5YHi3Jwi34f",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $resp = curl_exec($curl);
        curl_close($curl);
        $jsonObject = json_decode($resp);
        $clientRecords = $jsonObject->records[0]->fields;
        // dd($jsonObject->records[0]->fields);
        $clientDataId = $clientRecords->Data;
        $clientDatas = [];
        // dd($clientDataId);
        // foreach ($clientDataId as $id){
            // $data = $this->getClientData($id);
            // array_push($clientDatas, $data);
        // }
        $client = new Customer($clientRecords->Id, $clientRecords->CityName, $clientRecords->Email, $clientDataId);
        
        return $client;
    }
    
    public function getClientList () : array{

        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Client";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Authorization: Bearer keyWdc5YHi3Jwi34f",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $jsonObject = json_decode($resp);
        $clientRecords = $jsonObject->records;
        return $clientRecords;
    }

    public function getClientData ( $id)  {
        // dd($id);
        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Data/".$id; 
        // $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Data?filterByFormula=SEARCH('".$id."'%2C+%7BClient%7D)";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
        "Authorization: Bearer keyWdc5YHi3Jwi34f",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        $jsonObject = json_decode($resp);
        $data = $jsonObject->fields;

        return $data;
    }

    public function persist(Customer $customer){
        
    }
}

?>