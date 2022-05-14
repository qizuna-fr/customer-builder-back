<?php

namespace App\Services;

use App\Interfaces\TextCSSManagementInterface;

class DummyTextCSSManagement implements TextCSSManagementInterface {
    
    public function setTitleFont(string $titleFont) :string {
        return $titleFont;
    }
}

?>