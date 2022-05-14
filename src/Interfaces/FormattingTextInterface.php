<?php

namespace App\Interfaces;

interface FormattingTextInterface {
    
    public function deleteSpace(string $text) : string;

    public function lowerCase(string $text) :string;

}

?>