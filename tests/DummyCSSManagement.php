<?php

namespace App\Tests;

use App\Interfaces\CSSManagementInterface;
use App\Interfaces\CustomerInterface;

class DummyCSSManagementService implements CSSManagementInterface {

    public bool $spyTitleFont = false;
    public bool $spyParagraphFont = false;
    public bool $spyTitleStyle = false;
    public bool $spyParagraphStyle = false;
    public bool $spyTitleColor = false;
    public bool $spyParagraphColor = false;

    private $dummyCustomerData = [];

    public function __construct(
        private DummyDataBaseManagement $DummyDataBase,
        private CustomerInterface $dummyCustomer,
    ) 
    {
        $this->dummyCustomerData = $this->DummyDataBase->fetchData($this->dummyCustomer);
    }
    
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