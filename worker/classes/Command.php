<?php

abstract class Command {

    const PSEXEC = 'c:'.DIRECTORY_SEPARATOR.'installs'.DIRECTORY_SEPARATOR.'pstools'.DIRECTORY_SEPARATOR.'psexec.exe';
    const BAT_FIRST_LINE = 'cd %~dp0';
    const TAIL = 'c:'.DIRECTORY_SEPARATOR.'installs'.DIRECTORY_SEPARATOR.'unxutils'.DIRECTORY_SEPARATOR.'usr'.DIRECTORY_SEPARATOR.'local'.DIRECTORY_SEPARATOR.'wbin'.DIRECTORY_SEPARATOR.'tail.exe';

	protected function findPID($string)
    {
        $cmd = 'wmic process where "CommandLine like \'%'.str_replace(["\\","'"], ["\\\\","\\'"], $string).'%\' AND Caption!=\'WMIC.exe\'" get ProcessId';
        $out = `$cmd`;
        $lines = explode("\n",$out);
        $lines = array_map('trim', $lines);
        return trim($lines[1]);
    }

    /**
     * @param $pid
     * @return WindowsProcessInfo
     */
    protected function infoPID($pid) {
        $cmd = 'wmic process where "ProcessId='.($pid+0).'" get * /format:csv';
        $out = `$cmd`;
        $lines = explode("\n",trim($out));
        $lines = array_map('trim', $lines);

        $head = str_getcsv(trim($lines[0]));
        $info = str_getcsv(trim($lines[1]));

        $result = array();
        foreach ($info as $nr=>$cell) {
            $result[$head[$nr]] = $cell;
        }

        return new WindowsProcessInfo($result);
    }

    abstract function startIt();
    abstract function killIt();
    abstract function getHashRate();


}