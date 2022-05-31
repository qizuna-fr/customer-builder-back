<?php

namespace App\Services;

use App\Interfaces\CSSManagementInterface;

class CSSManagementService implements CSSManagementInterface {

    public bool $spyFont = false;
    public bool $spyStyle = false;
    public bool $spyColor = false;
    
    public function editFont(string $text, string $font)  {
        //code for edit
        $this->spyFont = true;
    }

    public function editStyle(string $text, string $style)  {
        //code for edit
        $this->spyStyle = true;
    }

    public function editColor(string $text, string $color)  {
        //code for edit
        $this->spyColor = true;
    }
}

?>