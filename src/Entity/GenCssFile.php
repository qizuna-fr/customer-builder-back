<?php

namespace App\Entity;

class GenCssFile
{
    public function __construct(array $cssParameters)
    {
        // dump($cssParameters);

        $keyName = array_keys($cssParameters);

        $file = "";
        $i = 0;

        $crlf = "\r\n";

        foreach ($cssParameters as $value) {
            $cssClassName = $keyName[$i];

            $file .= "." . $cssClassName . "\r\n{\r\n";
            $file .="\tfont-family: " . $value["font"] . ";" . $crlf;
            $file .= "\tcolor: " . $value["color"] . ";" . $crlf;

            $style = $value["style"];

            $file .= "\ttext-transform : " . $style["text-transform"] . ";" . $crlf;
            $file .= "\tfont-style : " . $style["font-style"] . ";" . $crlf;
            $file .= "\tfont-weight : " . $style["font-weight"] . ";";

            $file = $file . "\r\n}" . "\r\n";

            $i++;
        }

        // echo ($file);

        file_put_contents('qizunaCity.css', $file);
    }
}
