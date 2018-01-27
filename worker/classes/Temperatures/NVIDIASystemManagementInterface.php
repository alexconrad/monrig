<?php

namespace Temperatures;

class NVIDIASystemManagementInterface extends \Temperature {

	const NVIDIASMI = 'C:'.DIRECTORY_SEPARATOR.'Program Files'.DIRECTORY_SEPARATOR.'NVIDIA Corporation'.DIRECTORY_SEPARATOR.'NVSMI'.DIRECTORY_SEPARATOR;


	function getTemperature()
	{
		$current = getcwd();

		chdir(self::NVIDIASMI);
		$cmd2 = 'nvidia-smi.exe --format=csv,noheader --query-gpu=temperature.gpu';
		$out2 = `$cmd2`;

		$out2 = trim($out2);
		$lines = explode("\n", $out2);
		$lines = array_map('trim', $lines);

		chdir($current);

		return $lines;
	}


}