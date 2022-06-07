<?php
namespace App\Services\Dummy;

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

    public function getHeight () : int {
        return 120;
    }

    public function setHeight (int $height ) {

    }

    public function getWidth(): int {
        return 110;
    }

    public function setWidth(int $width) {

    }

}

?>