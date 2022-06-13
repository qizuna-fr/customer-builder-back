<?php

namespace App\Interfaces;

interface FileExportInterface
{

    public function add(string $filePath);
    public function export();
    
}


?>
