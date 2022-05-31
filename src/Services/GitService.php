<?php
namespace App\Services;

use App\Exceptions\ConnectionGitException;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use Exception;

class GitService implements GitServiceInterface {

    private bool $spyPing = false;
    public bool $spyAdd = false;
    public bool $spyCommit = false;
    public bool $spyPush = false;

    private function ping(){
        $this->spyPing = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spyPing) return ('Connected');
        else throw new ConnectionGitException();
    }

    public function disconnect() {
        return('Disconnected');
    }

    public function add(GitFileInterface $file, string $branchName)  {
        $this->connect();
        if (!$this->spyPing) throw new ConnectionGitException();
        $this->spyAdd = true;
    }

    public function commit(string $branchName, string $message){
        if (!$this->spyPing) throw new ConnectionGitException();
        if ($this->spyAdd) $this->spyCommit = true;
        else throw new Exception('you should add file first ! ');
    }

    public function push(GitFileInterface $file, string $branchName, string $message){
        if (!$this->spyPing) throw new ConnectionGitException();
        if ($this->spyCommit) $this->spyPush = true;
        else throw new Exception('you should commit first ! ');
    }
}

?>
