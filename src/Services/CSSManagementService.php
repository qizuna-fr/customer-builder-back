<?php

namespace App\Services;

use App\Interfaces\CSSManagementInterface;
use App\Interfaces\CustomerInterface;

class CSSManagementService implements CSSManagementInterface {

    public bool $spyFont = false;
    public bool $spyStyle = false;
    public bool $spyColor = false;

    public function editFont(string $textName, string $font)  {

        //code for edit font
        $this->spyFont = true;
    }

    public function editStyle(string $textName, string $style)  {

        //code for edit style
        $this->spyStyle = true;
    }

    public function editColor(string $textName, string $color)  {
        
        //code for edit color
        $this->spyColor = true;
    }
}

?>