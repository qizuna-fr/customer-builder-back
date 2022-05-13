<?php

namespace App\Interfaces;

interface GitHubServiceInterface {
    
    public function connectToGithub();

    public function disconnectFromGithub();

    public function createBranchGithub();

}

?>