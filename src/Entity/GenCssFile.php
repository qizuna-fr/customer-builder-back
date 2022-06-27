<?php

namespace App\Entity;

class GenCssFile
{
    private $file = "";

    public function __construct(string $cityName, array $cssParagraph, array $cssText)
    {

        self::extractAndGenCss("paragraph", $cssParagraph);
        self::extractAndGenCss("titleStyle", $cssText);

        file_put_contents("Temp/".$cityName.".css", $this->file);
    }

    private function extractAndGenCss($cssClassName, $ArrayData)
    {
        $this->file .= "." . $cssClassName . "\r\n{\r\n";
        foreach ($ArrayData as $key => $value) {
            if (!$value == "")
                $this->file .= "\t" . $key . ": " . $value . ";\r\n";
        }
        $this->file .= "}\r\n";
    }
}
