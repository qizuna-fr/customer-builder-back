<?php

namespace App\Interfaces;

interface GitHubServiceInterface {
    
    public function connectToGithub();

    public function disconnectFromGithub();

    public function addContent($content): string;

    public function createBranchGithub(string $branchName);

    public function createRepositoryGithub($githubClient);

    public function fetchRepository($githubClient) : string;

    public function fetchBranch(string $branchName) : string;

    public function addCommitMessage($githubClient, string $branchName, string $content, string $message);

    public function pushBranchGithub(string $githubClient, string $branchName);

    public function updateRepository ($githubClient, $branchName, $content, $message);

}

?>