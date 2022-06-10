<?php

namespace App\Interfaces;

interface CSSManagementInterface {
    
    public function editFont(string $textName, string $font);

    public function editStyle(string $textName, string $style);

    public function editColor(string $textName, string $color);
}

?>