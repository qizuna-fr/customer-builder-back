<?php

namespace App\Services;

use App\Interfaces\CSSManagementInterface;

class CSSManagementService implements CSSManagementInterface {

    public bool $spyTitleFont = false;
    public bool $spyParagraphFont = false;
    public bool $spyTitleStyle = false;
    public bool $spyParagraphStyle = false;
    public bool $spyTitleColor = false;
    public bool $spyParagraphColor = false;

    public function editFont(string $text, string $font)  {

        if ($text == 'title') {
            //code for edit title font
            $this->spyTitleFont = true;
        }

        if ($text == 'paragraph') {
            //code for edit paragraph font
            $this->spyParagraphFont = true;
        }
    }

    public function editStyle(string $text, string $style)  {

        if ($text == 'title') {
            //code for edit title style
            $this->spyTitleStyle = true;
        }

        if ($text == 'paragraph') {
            //code for edit paragraph style
            $this->spyParagraphStyle = true;
        }
    }

    public function editColor(string $text, string $color)  {
        
        if ($text == 'title') {
            //code for edit title color
            $this->spyTitleColor = true;
        }

        if ($text == 'paragraph') {
            //code for edit paragraph color
            $this->spyParagraphColor = true;
        }
    }
}

?>