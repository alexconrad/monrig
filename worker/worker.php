<?php

require_once 'classes/Command.php';
require_once 'classes/Commands/Claymore1.php';

require_once 'classes/Temperature.php';
require_once 'classes/Temperatures/NVIDIASystemManagementInterface.php';

//$a = new \Temperatures\NVIDIASystemManagementInterface();
//$gpus = $a->getTemperature();
//print_r($gpus);

$b = new \Commands\Claymore1();
$b->startIt();

echo "Sleeping 10 seconds ...";
sleep(10);
echo "done sleeping.\n. Ending command :";

$b->killIt();

echo "End.";


