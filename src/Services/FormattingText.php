<?php

namespace App\Services;

use App\Interfaces\FormattingTextInterface;

class FormattingText implements FormattingTextInterface {
    
    public function deleteSpace(string $text) :string {
        return $text;
    }

    public function lowerCase(string $text) :string {
        return $text;
    }
}
?>