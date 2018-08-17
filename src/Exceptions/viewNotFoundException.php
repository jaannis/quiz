<?php

namespace Quiz\Exceptions;
use Exception;

class viewNotFoundException extends Exception
{
    protected $message = 'View Not Found';
}