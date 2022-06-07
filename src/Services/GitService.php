<?php
namespace App\Services;

use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;

class GitService implements GitServiceInterface {

    public function ping(){
        $this->spyPing = true;
    }

    public function connect() {
    }

    public function add(GitFileInterface $file, string $branchName){
    }


    public function disconnect() {
    }

    public function commit(string $branchName, string $message){
    }

    public function push(GitFileInterface $file, string $branchName, string $message){
    }

    public function checkIsConnected() : bool{
        return true;
    }

    public function checkAdd() : bool{
        return true;
    }

    public function checkCommit() : bool{
        return true;
    }
}

?>
