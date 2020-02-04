<?php

namespace Softmetrix\PHPProcList\ProcMan;

class OSXProcMan implements IProcMan
{
    public function list()
    {
        // ps -A -o pid,command -o "|%p"
        return [];
    }

    public function kill($pid)
    {
        exec("kill -9 {$pid}");
    }

    public function running($pid)
    {
        $output = shell_exec("ps -p {$pid}");
        $output = trim($output);
        $outputLines = explode("\n", $output);

        return count($outputLines) > 1;
    }
}
