<?php

namespace App\Entity;

class GenCssFile
{
    public function __construct(array $cssParagraph, array $cssText)
    {
        // dump($cssParameters);

        // $cssClassName = array_keys($cssParameters);

        $file = "";
        $i = 0;

        $crlf = "\r\n";


        foreach ($cssParagraph as $key => $value)
        {
           echo($key);
           echo($value);

        }

        // foreach ($cssParameters as $value) {

            // $file .= "." . $cssClassName[$i] . "\r\n{\r\n";
            // $file .="\tfont-family: " . $value["font"] . ";" . $crlf;
            // $file .= "\tcolor: " . $value["color"] . ";" . $crlf;
            // $file .= "\ttext-transform : " . $value["text-transform"] . ";" . $crlf;
            // $file .= "\tfont-style : " . $value["font-style"] . ";" . $crlf;
            // $file .= "\tfont-weight : " . $value["font-weight"] . ";";

            // $file = $file . "\r\n}" . "\r\n";

        //     $i++;

        // }

        // echo ($file);

        file_put_contents('Assets/qizunaCity.css', $file);
    }

    private function extractAndGenCss($Arrayline)
    {
        dump($Arrayline);
    }
}
