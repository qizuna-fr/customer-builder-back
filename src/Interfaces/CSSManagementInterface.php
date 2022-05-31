<?php

namespace App\Interfaces;

interface CSSManagementInterface {
    
    public function editFont(string $text, string $font);

    public function editStyle(string $text, string $style);

    public function editColor(string $text, string $color);
}

?>