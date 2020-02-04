<?php

namespace Softmetrix\PHPProcList\ProcMan;

class LinuxProcMan implements IProcMan
{
    public function list()
    {
        return [];
    }

    public function kill($pid)
    {
        exec("kill -9 {$pid}");
    }

    public function running($pid)
    {
        return file_exists("/proc/{$pid}");
    }
}
