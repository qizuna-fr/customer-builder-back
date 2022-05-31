<?php

namespace App\Tests;

use App\Interfaces\CSSManagementInterface;

class DummyCSSManagementService implements CSSManagementInterface {

    public bool $spyTitleFont = false;
    public bool $spyParagraphFont = false;
    public bool $spyTitleStyle = false;
    public bool $spyParagraphStyle = false;
    public bool $spyTitleColor = false;
    public bool $spyParagraphColor = false;
    
    public function editFont(string $text, string $font)  {
        //code for edit
        if ($text == 'title')  $this->spyTitleFont = true;
        if ($text == 'paragraph')  $this->spyParagraphFont = true;
    }

    public function editStyle(string $text, string $style)  {
        //code for edit
        if ($text == 'title')  $this->spyTitleStyle = true;
        if ($text == 'paragraph')  $this->spyParagraphStyle = true;
    }

    public function editColor(string $text, string $color)  {
        //code for edit
        if ($text == 'title')  $this->spyTitleColor = true;
        if ($text == 'paragraph')  $this->spyParagraphColor = true;
    }
}

?>