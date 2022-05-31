<?php
namespace App\Tests;

use App\Interfaces\ImaginaryFileInterface;

class DummyImaginaryFile implements ImaginaryFileInterface {

    public function name() : string {
        return "logo";
    }

    public function getExtension() : string {
        return ".jpg";

    }

    public function setExtension(string $extension) {

    }

    public function getHight() : int {
        return 120;
    }

    public function setHight(int $hight) {

    }

    public function getWidth(): int {
        return 110;
    }

    public function setWidth(int $width) {

    }

}

?>