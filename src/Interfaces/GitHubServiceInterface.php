<?php

namespace App\Interfaces;

interface GitHubServiceInterface {
    
    public function connectToGithub();

    public function disconnectFromGithub();

    public function addContent($content): string;

    public function createBranchGithub(string $branchName);

    public function createRepositoryGithub($clientCityName);

    public function fetchRepository(string $clientCityName) : string;

    public function fetchBranch(string $branchName) : string;

    public function addCommitMessage(string $clientCityName, string $branchName, string $content, string $message);

    public function pushBranchGithub(string $clientCityName, string $branchName);

    public function updateRepository ($clientCityName, $repositoryName, $branchName, $content, $message);

}

?>