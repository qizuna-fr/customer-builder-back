<?php

namespace App\Services;

use App\Interfaces\TextCSSManagementInterface;

class TextCSSManagement implements TextCSSManagementInterface {
    
    public function setTitleFont(string $titleFont) :string {
        return $titleFont;
    }
}

?>