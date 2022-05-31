<?php

namespace App\Tests;

use App\Interfaces\CSSManagementInterface;
use App\Interfaces\CustomerInterface;

class DummyCSSManagementService implements CSSManagementInterface {

    public bool $spyFont = false;
    public bool $spyStyle = false;
    public bool $spyColor = false;


    public function editFont(string $textName, string $font)  {

        $this->spyFont = true;
    }

    public function editStyle(string $textName, string $style)  {

        $this->spyStyle = true;
    }

    public function editColor(string $textName, string $color)  {
        
        $this->spyColor = true;
    }
}

?>