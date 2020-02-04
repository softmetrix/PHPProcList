<?php

namespace Softmetrix\PHPProcList\Exception;

use Exception;

class UnknownOsException extends Exception
{
    protected $message = 'Unknown OS';
}
