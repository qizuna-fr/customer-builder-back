<?php

namespace App\Exceptions;

class ConnectionGitException extends \Exception
{
    protected $message = 'Connection to git failed !';
}

?>