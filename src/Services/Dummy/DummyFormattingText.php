<?php

namespace App\Services\Dummy;

use App\Interfaces\FormattingTextInterface;

class DummyFormattingText implements FormattingTextInterface {
    
    public function deleteSpace(string $text) :string {
        $formattedText = str_replace(' ', '-', $text);
        return $formattedText;
    }

    public function lowerCase(string $text) :string {
        $formattedText = strtolower($text);
        return $formattedText;
    }
}
?>