<?php

namespace App\Services;

use App\Interfaces\FormattingTextInterface;

class FormattingText implements FormattingTextInterface {
    
    public function deleteSpace(string $text) :string {
        $lowerCase = $this->lowerCase($text);
        $formattedText = str_replace(' ', '-', $lowerCase);
        return $formattedText;
    }

    public function lowerCase(string $text) :string {
        $formattedText = strtolower($text);
        return $formattedText;
    }
}
?>