<?php

namespace App\Interfaces;

interface TextCSSManagementInterface {
    
    public function editTextFont(string $textFont);

    public function editTextStyle(string $textStyle);

    public function editTextColor(string $textColor);
}

?>