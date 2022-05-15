<?php
namespace App\Services;

use App\Interfaces\GitHubServiceInterface;

class GitHubService implements GitHubServiceInterface {

    public function connectToGithub() {
    }

    public function disconnectFromGithub() {
    }

    public function addContent($content) :string {
        return "";
    }

    public function createBranchGithub(string $branchName) {
    }

    public function createRepositoryGithub($clientCityName){

    }
    
    public function fetchRepository(string $clientCityName) : string {
        return "";
    }

    public function fetchBranch(string $branchName) : string {
        return "";
    }

    public function addCommitMessage(string $clientCityName, string $branchName, string $content, string $message) {

    }

    public function pushBranchGithub(string $clientCityName, string $branchName) {

    }

    public function updateRepository ($clientCityName, $repositoryName, $branchName, $content, $message) {
        
    }
}

?>
