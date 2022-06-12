<?php
namespace App\Services\Dummy;

use App\Interfaces\CustomerInterface;

class DummyCustomer implements CustomerInterface {

    public function getId() : int {

        return $this->id;
    }

    public function setId(int $id) {

        $this->id = $id;
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

    // public function getData() :array {
    //     $data = array(
    //         'cityName' => 'Mulhouse' , 
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

    // public function setData(array $customerData){
        
    // }

    public function getTitleStyle() : array{
        return [];
    }

    public function setTitleStyle(array $titleStyle){
    }

    public function setParagraphStyle(array $paragraphStyle){

    }

    public function getParagraphStyle() : array{
        return [];
    }

    public function setFiles(array $files){

    }

    public function getFiles() : array{
        return [];
    }

    public function setDatas(array $datas){
        $this->datas = $datas;
    }

    public function getDatas() : array{
        return $this->datas;
    }

}

?>