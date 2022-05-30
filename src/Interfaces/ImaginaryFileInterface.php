<?php

namespace App\Interfaces;

interface ImaginaryFileInterface {

    public function name() : string;

    public function getExtension() : string;

    public function setExtension(string $extension);

    public function getHight() : int;

    public function setHight(int $hight);

    public function setWidth(): int;

    public function getWidth(int $width);

}

?>