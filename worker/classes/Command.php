<?php

abstract class Command {

    const PSEXEC = 'c:'.DIRECTORY_SEPARATOR.'installs'.DIRECTORY_SEPARATOR.'pstools'.DIRECTORY_SEPARATOR.'psexec.exe';
    const BAT_FIRST_LINE = 'cd %~dp0';

	protected function findPID($string)
    {
        $cmd = 'wmic process where "CommandLine like \'%'.str_replace(["\\","'"], ["\\\\","\\'"], $string).'%\' AND Caption!=\'WMIC.exe\'" get ProcessId';
        $out = `$cmd`;
        $lines = explode("\n",$out);
        $lines = array_map('trim', $lines);
        return trim($lines[1]);
    }

    abstract function startIt();
    abstract function killIt();


}