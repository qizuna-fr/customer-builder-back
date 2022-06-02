<?php
namespace App\Services;

use App\Exceptions\ConnectionGitException;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use Exception;

class GitService implements GitServiceInterface {

    public bool $spyPing = false;
    public bool $spyAdd = false;
    public bool $spyCommit = false;
    public bool $spyPush = false;

    public function ping(){
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
        if ($this->spyPing) {
            $this->spyAdd = true;

            //code
        }
        else throw new Exception('You should connect to Git first !');
    }

    public function commit(string $branchName, string $message){
        if ($this->spyAdd) {
            $this->spyCommit = true;

            //code
        }
        else throw new Exception('you should add file first ! ');
    }

    public function push(GitFileInterface $file, string $branchName, string $message){
        if ($this->spyCommit) {
            $this->spyPush = true;

            //code

        }
        else throw new Exception('you should commit first ! ');
    }
}

?>
