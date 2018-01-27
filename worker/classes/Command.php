<?php

abstract class Command {

	protected function run($sWorkingDir, $sCommand) {
		$pwd = getcwd();

		chdir($sWorkingDir);

		$out = `$sCommand`;



	}


}