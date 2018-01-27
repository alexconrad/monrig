<?php

require_once 'classes/Command.php';
require_once 'classes/Commands/Claymore1.php';

require_once 'classes/Temperature.php';
require_once 'classes/Temperatures/NVIDIASystemManagementInterface.php';

$a = new \Temperatures\NVIDIASystemManagementInterface();

$gpus = $a->getTemperature();

$debug_var=$gpus;echo '<pre style="font: normal 10pt Tahoma;"><hr>';echo 'This debug of $gpus is in file :<b>'.__FILE__.'</b> at line <b>'.__LINE__.'</b> (class/method:  <b>$'.__CLASS__.'->&gt;</b>)'."\n";if ((is_array($debug_var)) || (is_object($debug_var))) print_r($debug_var);else echo $debug_var; echo '<hr></pre>';unset($debug_var);


$b = new \Commands\Claymore1();
$b->killIt();
