<?php
namespace App\Tests;

use App\Interfaces\CustomerInterface;

class DummyCustomer implements CustomerInterface {

    public function getId() : int {

        return 1;
    }

    public function getName() : string {

        return "Mulhouse";
    }

    public function getEmail(): string {

        return "mulhouse@mail.fr";
    }

    public function getData() :array {
        $data = array(
            'cityName' => 'Mulhouse' , 
            'title' => [
                'font' => 'Open sans', 
                'color' =>'blue', 
                'style' => [
                    'text-transform' => 'italic', 
                    'font-weight' => 'bold', 
                    'font-style' => 'capitalize'
                ]
            ], 
            'paragraph' => [
                'font' => 'Open sans', 
                'color' =>'black', 
                'style' => [
                    'text-transform' => 'normal', 
                    'font-weight' => 'normal', 
                    'font-style' => 'normal'
                ]
            ],
            'files' => [
                'logo' =>
                    ['name' => 'file1.jpg', 'width' => '100', 'hight' => '120', 'extension' => 'jpg'], 
                'background' => 
                    ['name' => 'file2.png', 'width' => '110', 'hight' => '150', 'extension' => 'jpeg']
            ]
        );
        return $data;
    }

    public function setData(array $customerData){
        
    }
}

?>