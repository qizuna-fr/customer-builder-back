<?php

namespace App\Services\Dummy;

use App\Interfaces\TextCSSManagementInterface;

class DummyTextCSSManagement implements TextCSSManagementInterface {

    public bool $spy;
    
    public function editTextFont(string $textFont)  {
        $this->spy =  ($textFont == "" ) ? false : true;
        return $this->spy;
    }

    public function editTextStyle(string $textStyle)  {
        $this->spy =  ($textStyle == "" ) ? false : true;
        return $this->spy;
    }

    public function editTextColor(string $textColor)  {
        $this->spy =  ($textColor == "" ) ? false : true;
        return $this->spy;
    }


}

?>