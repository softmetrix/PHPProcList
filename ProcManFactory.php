<?php

namespace Softmetrix\PHPProcList;

use Softmetrix\PHPProcList\ProcMan\OSXProcMan;

class ProcManFactory
{
    const OS_LINUX = 'Linux';
    const OS_WINDOWS = 'Windows';
    const OS_OSX = 'OSX';

    public static function create($osString)
    {
        return new OSXProcMan();
    }
}
