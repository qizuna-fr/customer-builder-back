<?php

namespace App\Services;

use App\Interfaces\TextCSSManagementInterface;

class TextCSSManagement implements TextCSSManagementInterface {
    
    public function editTextFont(string $textFont) {
        return $textFont;
    }

    public function editTextStyle(string $textStyle) {
        return $textStyle;
    }

    public function editTextColor(string $textColor) {
        return $textColor;
    }
}

?>