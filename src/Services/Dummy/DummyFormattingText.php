<?php

namespace App\Services;

use App\Interfaces\FormattingTextInterface;
use Symfony\Bundle\MakerBundle\Str;

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