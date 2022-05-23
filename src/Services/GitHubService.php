<?php
namespace App\Services;

use App\Interfaces\GitHubServiceInterface;

class GitHubService implements GitHubServiceInterface {

    public function connectToGithub() {
        return ('Connected');
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
