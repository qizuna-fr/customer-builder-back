<?php
namespace App\Services;

use App\Interfaces\GitHubServiceInterface;
use Exception;

class GitHubService implements GitHubServiceInterface {

    public bool $spy = false;

    private function ping(){
        $this->spy = true;
    }

    public function connectToGithub() {
        $this->ping();
        if ($this->spy) return ('Connected');
        else throw new Exception("error");
    }

    public function disconnectFromGithub() {
        return('Disconnected');
    }

    public function addFileToGithub($file, string $branchName)  {
        
    }

    public function addCommitMessage(string $branchName, string $message){

    }

    public function pushFileToGithub(string $file, string $branchName, string $message){
        
    }
}

?>
