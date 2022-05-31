<?php

namespace App\Interfaces;

interface GitServiceInterface {
    
    public function connect();

    public function disconnect();

    public function add(GitFileInterface $file, string $branchName);

    public function commit(string $branchName, string $message);

    public function push(GitFileInterface $file, string $branchName, string $message);

}

?>