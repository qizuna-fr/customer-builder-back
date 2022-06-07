<?php

namespace App\Interfaces;

interface ImaginaryFileInterface {

    public function name() : string;

    public function getExtension() : string;

    public function setExtension(string $extension);

    public function getHeight () : int;

    public function setHeight (int $height );

    public function getWidth(): int;

    public function setWidth(int $width);

}

?>