<?php

namespace Softmetrix\PHPProcList\ProcMan;

class LinuxProcMan implements IProcMan
{
    public function list()
    {
        $psOutput = shell_exec('ps -A -o pid,command');
        $psOutput = trim($psOutput);
        $psLines = explode("\n", $psOutput);
        $psLines = array_map('trim', $psLines);
        $psLines = array_map(function ($el) {
            return explode(' ', $el, 2);
        }, $psLines);
        $list = [];
        for ($i = 1; $i < count($psLines); ++$i) {
            $list[] = [
                'pid' => $psLines[$i][0],
                'title' => $psLines[$i][1],
            ];
        }

        return $list;
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
