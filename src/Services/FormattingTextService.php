<?php

namespace App\Services;

use App\Interfaces\CustomerInterface;
use App\Interfaces\FormattingTextInterface;

class FormattingTextService implements FormattingTextInterface {

    public $spyLowerCase = false ;
    public $spyDeleteSpace = false ;
    
    public function deleteSpace(string $text) :string {
        $lowerCase = $this->lowerCase($text);
        $formattedText = str_replace(' ', '-', $lowerCase);
        $this->spyDeleteSpace = true;
        return $formattedText;
    }

    public function lowerCase(string $text) :string {
        $this->spyLowerCase = true;
        $formattedText = strtolower($text);
        return $formattedText;
    }
}
?>