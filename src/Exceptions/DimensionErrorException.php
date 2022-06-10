<?php

namespace App\Exceptions;

class DimensionErrorException extends \Exception
{
    protected $message = 'image dimensions should be > 100 px !';
}

?>