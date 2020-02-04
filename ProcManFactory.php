<?php

namespace Softmetrix\PHPProcList;

use Softmetrix\PHPProcList\Exception\UnknownOsException;
use Softmetrix\PHPProcList\ProcMan\LinuxProcMan;
use Softmetrix\PHPProcList\ProcMan\OSXProcMan;
use Softmetrix\PHPProcList\ProcMan\WinProcMan;

class ProcManFactory
{
    const OS_LINUX = 'Linux';
    const OS_WINDOWS = 'Windows';
    const OS_OSX = 'OSX';

    public static function create($osString)
    {
        switch ($osString) {
            case self::OS_WINDOWS:
                return new WinProcMan();
            break;
            case self::OS_OSX:
                return new OSXProcMan();
            break;
            case self::OS_LINUX:
                return new LinuxProcMan();
            break;
        }
    }

    public static function getOs()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            return self::OS_WINDOWS;
        } elseif (PHP_OS == 'Darwin') {
            return self::OS_OSX;
        } elseif (PHP_OS == 'Linux') {
            return self::OS_LINUX;
        } else {
            throw new UnknownOsException();
        }
    }
}
