<?php

namespace Softmetrix\PHPProcList\ProcMan;

interface IProcMan
{
    public function list();

    public function kill($pid);
}
