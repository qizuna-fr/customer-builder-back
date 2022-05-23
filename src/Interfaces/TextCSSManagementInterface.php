<?php

namespace App\Interfaces;

interface TextCSSManagementInterface {
    
    public function editTextFont(string $text, string $font);

    public function editTextStyle(string $text, string $style);

    public function editTextColor(string $text, string $color);
}

?>