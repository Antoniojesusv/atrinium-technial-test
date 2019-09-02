<?php

namespace App\Exceptions;

class SectorException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
