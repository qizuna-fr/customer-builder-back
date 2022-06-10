<?php

namespace App\Exceptions;

class ExtensionErrorException extends \Exception
{
    protected $message = 'Cannot convert file, please choose a correct extension !';
}

?>