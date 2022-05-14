<?php
namespace App\Services;

use App\Interfaces\GitHubServiceInterface;

class GitHubService implements GitHubServiceInterface {

    public function connectToGithub() {
    }

    public function disconnectFromGithub() {
    }

    public function createBranchGithub(string $branchName) {
    }

    public function fetchDataFromDataBase() : array {
        return [];
    }
}

?>
