<?php

namespace Commands;


class Claymore1 extends \Command {

	const FULLNAME = 'Claymore\'s Dual Ethereum+Decred_Siacoin_Lbry_Pascal AMD+NVIDIA GPU Miner v10.3';

	const COMMAND_WORKING_DIR = 'i:'.DIRECTORY_SEPARATOR.'Mine'.DIRECTORY_SEPARATOR.'Claymore\'s Dual Ethereum+Decred_Siacoin_Lbry_Pascal AMD+NVIDIA GPU Miner v10.3'.DIRECTORY_SEPARATOR;

	public function runCommand() {
		$cmd = 'EthDcrMiner64.exe -epool pirl.minerpool.net:8004 -ewal 0x7A9C3f6C0d51D5129c4aF1202228A4664f9F92BC -epsw x -ethi 8 -allpools 1 -esm 0 -allcoins 1 -ttli 89,86 -tstop -92';
	}

	public function findPID() {
		//$out = `tasklist /FI "IMAGENAME eq EthDcrMiner64*" /FO CSV`;
		//echo "$out";

		$out = '"Image Name","PID","Session Name","Session#","Mem Usage"
"EthDcrMiner64.exe","1700","Console","1","26,296 K"';

		$result = array();
		$lines = explode("\n",$out);
		$lines = array_map('trim', $lines);
		foreach ($lines as $line_nr=>$line) {
			if ($line_nr == 0) {
				$header = str_getcsv($line);
			}else{
				$aLine = str_getcsv($line);
				foreach ($aLine as $nr=>$cell) {
					/** @noinspection PhpUndefinedVariableInspection */
					$result[$header[$nr]] = $cell;
				}
			}
		}

		$debug_var=$result;echo '<pre style="font: normal 10pt Tahoma;"><hr>';echo 'This debug of $result is in file :<b>'.__FILE__.'</b> at line <b>'.__LINE__.'</b> (class/method:  <b>$'.__CLASS__.'->&gt;</b>)'."\n";if ((is_array($debug_var)) || (is_object($debug_var))) print_r($debug_var);else echo $debug_var; echo '<hr></pre>';unset($debug_var);






	}


}