<?php

namespace App\Interfaces;

interface GitHubServiceInterface {
    
    public function connectToGithub();

    public function disconnectFromGithub();

    public function addFileToGithub($file, string $branchName);

    public function addCommitMessage(string $branchName, string $message);

    public function pushFileToGithub(string $file, string $branchName, string $message);

}

?>