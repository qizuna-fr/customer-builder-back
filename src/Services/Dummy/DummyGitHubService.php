<?php
namespace App\Services\Dummy;

use App\Interfaces\GitHubServiceInterface;
use Exception;

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

    public function addContent($content) : string {
        return ($content == "" ) ? "" : $content;
    }

    public function createBranchGithub(string $branchName) {
        $this->spy =  ($branchName == "" ) ? false : true;
        return $this->spy;
    }

    public function createRepositoryGithub($clientCityName){
        $repositoryName = $this->fetchRepository($clientCityName);
        $this->spy =  ($repositoryName == "") ? false : true;
        return $this->spy;
    }

    public function fetchRepository(string $clientCityName) : string {
        $repositoryName = ($clientCityName != "") ? $clientCityName."-repository" : "";
        return $repositoryName;
    }

    public function fetchBranch(string $branchName) : string {
        return ($branchName != "") ? $branchName : "";
    }

    public function addCommitMessage(string $clientCityName, string $branchName, string $content, string $message) {
        $repositoryName = $this->fetchRepository($clientCityName);
        $branch = $this->fetchBranch($branchName);
        $this->spy = ($branch != "" & $repositoryName != "") ? true : false;
        return $this->spy;
    }

    public function pushBranchGithub(string $clientCityName, string $branchName) {
        $repositoryName = $this->fetchRepository($clientCityName);
        $branch = $this->fetchBranch($branchName);
        $this->spy = ($branch != "" & $repositoryName != "") ? true : false;
        return $this->spy;
    }

    public function updateRepository ($clientCityName, $repositoryName, $branchName, $content, $message) {
        $branch = $this->fetchBranch($branchName);
        if ($repositoryName == "") $repositoryName = $clientCityName."-repository";
        if ($branch == "") $branchName = $this->createBranchGithub($branchName);
        $this->addCommitMessage($repositoryName, $branchName, $content, $message);
        $this->pushBranchGithub($repositoryName, $branchName);
    }
}

?>
