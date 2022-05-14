<?php
namespace App\Services\Dummy;

use App\Interfaces\GitHubServiceInterface;
use Exception;
use SplDoublyLinkedList;

class DummyGitHubService implements GitHubServiceInterface {

    public bool $spy;

    public function connectToGithub() {
        $status = 200;
        if ($status == 200) return 200;
        else throw new Exception("error");
    }

    public function disconnectFromGithub() {
        return('Disconnected');
    }

    public function createBranchGithub(string $branchName) {
        $this->spy =  ($branchName == "" ) ? false : true;
        return $this->spy;
    }

    public function fetchDataFromDataBase() :array {
        $data = [
            'cityName' => 'cityName' , 
            'titleFont' => 'titleFont', 
            'titleColor' => 'titleColor', 
            'paragraphFont' => 'paragraphFont', 
            'paragraphColor' => 'paragraphColor'];
            
        return $data;
    }
}

?>
