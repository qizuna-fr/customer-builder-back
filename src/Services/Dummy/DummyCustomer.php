<?php
namespace App\Services\Dummy;

use App\Interfaces\CustomerInterface;

class DummyCustomer implements CustomerInterface {

    public function getId() : int {

        return 1;
    }

    public function getName() : string {

        return "Mulhouse";
    }

    public function setName(string $mail) {
        
    }

    public function getEmail(): string {

        return "mulhouse@mail.fr";
    }

    public function setEmail(string $mail) {

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
                    ['name' => 'file1.jpg', 'width' => '100', 'height' => '120', 'extension' => 'jpg'], 
                'background' => 
                    ['name' => 'file2.png', 'width' => '110', 'height' => '150', 'extension' => 'jpeg']
            ]
        );
        return $data;
    }

    public function setData(array $customerData){
        
    }

}

?>