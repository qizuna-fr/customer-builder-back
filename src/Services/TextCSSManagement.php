<?php

namespace App\Services;

use App\Interfaces\TextCSSManagementInterface;

class TextCSSManagement implements TextCSSManagementInterface {

    public bool $spyFont = false;
    public bool $spyStyle = false;
    public bool $spyColor = false;
    
    public function editTextFont(string $text, string $font)  {
        //code for edit
        $this->spyFont = true;
    }

    public function editTextStyle(string $text, string $style)  {
        //code for edit
        $this->spyStyle = true;
    }

    public function editTextColor(string $text, string $color)  {
        //code for edit
        $this->spyColor = true;
    }
}

?>