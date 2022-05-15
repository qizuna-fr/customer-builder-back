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

    public function createRepositoryGithub($githubClient){
        $repositoryName = $this->fetchRepository($githubClient);
        $this->spy =  ($repositoryName == "") ? false : true;
        return $this->spy;
    }

    public function fetchRepository($githubClient) : string {
        $repositoryName = ($githubClient != "") ? $githubClient."-repository" : "";
        return $repositoryName;
    }

    public function fetchBranch(string $branchName) : string {
        return ($branchName != "") ? $branchName : "";
    }

    public function addCommitMessage($githubClient, string $branchName, string $content, string $message) {
        $repositoryName = $this->fetchRepository($githubClient);
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

    public function updateRepository ($clientCityName, $branchName, $content, $message) {
        $repository = $this->fetchRepository($clientCityName);
        if ($repository == "") $repository = $clientCityName."-repository";
        $this->addCommitMessage($repository, $branchName, $content, $message);
        $this->pushBranchGithub($repository, $branchName);
    }
}

?>
