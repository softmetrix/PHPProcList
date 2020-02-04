<?php

namespace Softmetrix\PHPProcList\ProcMan;

class WinProcMan implements IProcMan
{
    public function list()
    {
        $taskList = shell_exec('tasklist 2>NUL');
        $taskList = trim($taskList);
        $taskTable = explode("\n", trim($taskList));
        $delimiters = explode(' ', $taskTable[1]);
        $titleColumnStart = 0;
        $titleColumnLength = strlen($delimiters[0]);
        $pidColumnStart = strlen($delimiters[0]) + 1;
        $pidColumnLength = strlen($delimiters[1]);
        $list = [];
        foreach ($taskTable as $key => $task) {
            if ($key > 1) {
                $pid = (int) substr($task, $pidColumnStart, $pidColumnLength);
                $title = substr($task, $titleColumnStart, $titleColumnLength);
                $list[] = [
                    'pid' => $pid,
                    'title' => $title,
                ];
            }
        }

        return $list;
    }

    public function kill($pid)
    {
        exec("taskkill /F /PID {$pid}");
    }

    public function running($pid)
    {
        $taskList = shell_exec('tasklist 2>NUL');
        $taskList = trim($taskList);
        $taskTable = explode("\n", trim($taskList));
        $delimiters = explode(' ', $taskTable[1]);
        $pidColumnStart = strlen($delimiters[0]) + 1;
        $pidColumnLength = strlen($delimiters[1]);
        $pids = [];
        foreach ($taskTable as $key => $task) {
            if ($key > 1) {
                $pids[] = (int) substr($task, $pidColumnStart, $pidColumnLength);
            }
        }

        return in_array($pid, $pids);
    }
}
