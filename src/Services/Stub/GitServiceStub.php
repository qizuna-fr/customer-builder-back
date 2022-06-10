<?php
namespace App\Services\Stub;

use App\Exceptions\ConnectionGitException;
use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use Exception;

class GitServiceStub implements GitServiceInterface {

    public bool $spyHasCheckConnection = false;

    public bool $spyCheckAddFile = false;

    public bool $spyCheckFileIsCommitTed = false;

    public bool $spyPing = false;

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
    }


    public function disconnect() {
        return('Disconnected');
    }

    public function commit(string $branchName, string $message){
        $this->checkhasFileToCommit(); 
    }

    public function push(GitFileInterface $file, string $branchName, string $message){
        $this->checkBranchIsCommited();
    }

    public function checkIsConnected() : bool{
        $this->spyHasCheckConnection = true;
        return $this->spyHasCheckConnection;
    }

    public function checkhasFileToCommit() : bool{
        $this->spyCheckAddFile = true;
        return $this->spyCheckAddFile;
    }

    public function checkBranchIsCommited() : bool{
        $this->spyCheckFileIsCommitTed = true;
        return $this->spyCheckFileIsCommitTed;
    }

}
?>