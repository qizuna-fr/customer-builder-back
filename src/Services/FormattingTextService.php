<?php

namespace App\Services;

use App\Interfaces\FormattingTextInterface;
use Exception;

class FormattingTextService implements FormattingTextInterface {

    public $spyLowerCase = false ;
    public $spyDeleteSpace = false ;
    
    public function deleteSpace(string $text) :string {
        $this->lowerCase($text);
        if ($this->spyLowerCase){
            $this->spyDeleteSpace = true;
        }
        else throw new Exception('You should use lowercase function first !');
        $formattedText = str_replace(' ', '-', $text);
        return $formattedText;
    }

    public function lowerCase(string $text) :string {
        $this->spyLowerCase = true;
        $formattedText = strtolower($text);
        return $formattedText;
    }
}
?>