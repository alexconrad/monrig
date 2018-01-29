<?php

namespace Commands;


class Claymore1 extends \Command {

	const FULLNAME = 'Claymore\'s Dual Ethereum+Decred_Siacoin_Lbry_Pascal AMD+NVIDIA GPU Miner v10.3';
    const BAT_FILE = 'C:'.DIRECTORY_SEPARATOR.'Mine'.DIRECTORY_SEPARATOR.'Claymore\'s Dual Ethereum+Decred_Siacoin_Lbry_Pascal AMD+NVIDIA GPU Miner v10.3'.DIRECTORY_SEPARATOR.'mystart.bat'; //FULL PATH
    const LOG_FILE = 'C:'.DIRECTORY_SEPARATOR.'mine.txt';

    public function __construct()
    {

        if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
            throw new \Exception('This command can only run on windows', 6001);
        }

        if (!file_exists(self::TAIL)) {
            throw new \Exception('TAIL.EXE file does not exist: '.self::TAIL."\nInstall GNU Utilities for Win32. Can be downloaded from: https://sourceforge.net/projects/unxutils/", 6002);
        }

        if (!file_exists(self::BAT_FILE)) {
            throw new \Exception('Bat file does not exist: '.self::BAT_FILE, 6002);
        }

        $fp = fopen(self::BAT_FILE, 'r');
        $first_line = fgets($fp);
        $first_line = trim($first_line);
        if ($first_line != self::BAT_FIRST_LINE) {
            fclose($fp);
            throw new \Exception('BAT first line needs to be '.self::BAT_FIRST_LINE, 6003);
        }
        fclose($fp);

    }

    public function getHashRate() {
        $cmd = self::TAIL.' -n 50 '.self::LOG_FILE;
        $out = `$cmd`;
        $lines = explode("\n", $out);
        //print_r($lines);
        $lines = array_reverse($lines);
        foreach ($lines as $line) {
            if (stristr($line, 'Total Speed:')) {
                \Log::show($line);
                $hashRate = \Log::getBetween($line,'Total Speed:','Mh/s');
                return $hashRate;
            }
        }
    }

	public function startIt()
    {

        $pid = $this->findPID(self::BAT_FILE);
        $pid+=0;

        if ($pid != 0) {
            $oInfo = $this->infoPID($pid);
            throw new \Exception('Already running with PID '.$pid.' : '.$oInfo->CommandLine, 6005);
        }



        $cmd = self::PSEXEC.' -d "'.self::BAT_FILE.'" > c:\\lala.txt';
        shell_exec($cmd);

        $pid = $this->findPID(self::BAT_FILE);
        $pid+=0;

        if ($pid == 0) {
            throw new \Exception('Cannot retrieve PID of process !', 6004);
        }

        echo "Started PID ".$pid." : ".self::BAT_FILE."\n";

    }

	public function killIt() {

        $pid = $this->findPID(self::BAT_FILE);
        $cmd = 'taskkill /PID '.$pid;
        $out = `$cmd`;

        echo $out.'!!';

    }


}