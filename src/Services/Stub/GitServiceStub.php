<?php
namespace App\Services\Stub;

use App\Exceptions\ConnectionGitException;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use Exception;

class GitServiceStub implements GitServiceInterface {

    public bool $spyHasCheckConnection = false;

    public bool $spyCheckAdd = false;

    public bool $spyCheckCommit = false;

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

    public function add(GitFileInterface $file, string $branchName){
        $this->checkIsConnected();
        if (!$this->spyHasCheckConnection) throw new Exception('You should connect to Git first !');
    }


    public function disconnect() {
        return('Disconnected');
    }

    public function commit(string $branchName, string $message){
        $this->checkAdd();
        if (!$this->spyCheckAdd) throw new Exception('you should add file first ! ');
    }

    public function push(GitFileInterface $file, string $branchName, string $message){
        $this->checkCommit();
        if (!$this->spyCheckCommit) throw new Exception('you should commit first ! ');
    }

    public function checkIsConnected() : bool{
        $this->spyHasCheckConnection = true;
        return $this->spyHasCheckConnection;
    }

    public function checkAdd() : bool{
        $this->spyCheckAdd = true;
        return $this->spyCheckAdd;
    }

    public function checkCommit() : bool{
        $this->spyCheckCommit = true;
        return $this->spyCheckCommit;
    }

}
?>