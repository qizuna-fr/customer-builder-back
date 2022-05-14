<?php

namespace App\Services;

use App\Interfaces\TextCSSManagementInterface;

class DummyTextCSSManagement implements TextCSSManagementInterface {

    public bool $spy;
    
    public function setTitleFont(string $titleFont) :string {
        $this->spy =  ($titleFont == "" ) ? false : true;
        return $this->spy;
    }
}

?>