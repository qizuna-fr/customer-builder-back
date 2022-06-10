<?php

namespace App\Entity;

use App\Interfaces\FileExportInterface;
use Exception;
use ZipArchive;

class ZipFile implements FileExportInterface
{
    private $zip;

    public function __construct($filename)
    {
        $this->zip = new ZipArchive();
        if (!$this->zip->open($filename, ZipArchive::CREATE))
            throw new Exception("Zip creation error");
    }

    public function add($filePath)
    {
        if (!$this->zip->addFile($filePath))
            throw new Exception("Zip add error");
        
    }

    public function export()
    {
        $this->zip->close();
    }
}
