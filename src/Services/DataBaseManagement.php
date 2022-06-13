<?php
namespace App\Services;

use App\Interfaces\DataBaseManagementInterface;

class DataBaseManagement implements DataBaseManagementInterface {
    
    public function __construct()
    {
    }

    public function fetchCustomerByCityName(string $cityName) : Customer{

        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Client?filterByFormula=SEARCH('".$cityName."'%2C+%7BcityName%7D)";

        $resp = $this->getCurlResponse($url);
        
        $jsonObject = json_decode($resp);
        $clientRecords = $jsonObject->records[0]->fields;
        // dd($jsonObject->records[0]->fields);
        $clientDataId = $clientRecords->Data;
        $client = new Customer($clientRecords->Id, $clientRecords->CityName, $clientRecords->Email, $clientDataId);
        
        return $client;
    }
    
    public function getClientList () : array{

        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Client";

        $resp = $this->getCurlResponse($url);

        $jsonObject = json_decode($resp);
        $clientRecords = $jsonObject->records;
        return $clientRecords;
    }

    public function getClientData ( $id)  {
        // dd($id);
        $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Data/".$id; 
        // $url = "https://api.airtable.com/v0/app9QhNsv5170O8Iw/Data?filterByFormula=SEARCH('".$id."'%2C+%7BClient%7D)";
        $resp = $this->getCurlResponse($url);
        $jsonObject = json_decode($resp);
        $data = $jsonObject->fields;

        return $data;
    }

    private function getCurlResponse(string $url) {
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
        return $resp;
    }

    public function persist(Customer $customer){
        
    }
}

?>