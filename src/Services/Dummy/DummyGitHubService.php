<?php
namespace App\Services\Dummy;

use App\Interfaces\GitHubServiceInterface;

class DummyGitHubService implements GitHubServiceInterface {

    public function connectToGithub() {
        return ('Connected');
    }

    public function disconnectFromGithub() {
        return('Disconnected');
    }

    public function createBranchGithub() {
        return('Branch Created');

    }
}

?>
