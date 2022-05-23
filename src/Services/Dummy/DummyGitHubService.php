<?php
namespace App\Services\Dummy;

use App\Interfaces\GitHubServiceInterface;
use Exception;

class DummyGitHubService implements GitHubServiceInterface {

    public function connectToGithub(){

    }

    public function disconnectFromGithub(){

    }

    public function addFileToGithub($file, string $branchName){

    }

    public function addCommitMessage(string $branchName, string $message){

    }

    public function pushFileToGithub(string $file, string $branchName, string $message){
        
    }
}

?>
