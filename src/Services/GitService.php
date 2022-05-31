<?php
namespace App\Services;

use App\Interfaces\GitFileInterface;
use App\Interfaces\GitServiceInterface;
use Exception;

class GitService implements GitServiceInterface {

    public bool $spy = false;

    private function ping(){
        $this->spy = true;
    }

    public function connect() {
        $this->ping();
        if ($this->spy) return ('Connected');
        else throw new Exception("error");
    }

    public function disconnect() {
        return('Disconnected');
    }

    public function add(GitFileInterface $file, string $branchName)  {
        
    }

    public function commit(string $branchName, string $message){

    }

    public function push(GitFileInterface $file, string $branchName, string $message){
        
    }
}

?>
