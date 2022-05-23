<?php

namespace App\Services\Dummy;

use App\Interfaces\FormattingTextInterface;

class DummyFormattingText implements FormattingTextInterface {
    
    public function deleteSpace(string $text) :string {
        return "";
    }

    public function lowerCase(string $text) :string {
        return "";
    }
}
?>