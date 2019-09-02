<?php

namespace App\Exceptions;

class CompanyException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
