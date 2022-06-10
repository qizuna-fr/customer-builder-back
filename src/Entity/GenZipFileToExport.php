<?php

class GenZipFileToExport
{
    private $filename;
    private $flag;

    public function __construct()
    {
    }

    public function genCssFile()
    {
    }

    public function genImgFile()
    {
    }

    public function genZipFile()
    {
        $newArchive = new ZipArchive();
        $newArchive->open($this->filename, $this->flag);
        $newArchive->close();
    }
}
