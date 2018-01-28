<?php
date_default_timezone_set('UTC');

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'Autoloader.php';

// PSR-0 compliant classes are stored in 'classes/'
$autoloaderPSR = new \Autoloader('', dirname(__FILE__).DIRECTORY_SEPARATOR.'classes');
$autoloaderPSR->register();

Log::init();

//$a = new \Temperatures\NVIDIASystemManagementInterface();
//$gpus = $a->getTemperature();
//print_r($gpus);
try {
    $b = new \Commands\Claymore1();
    $b->startIt();

    echo "Sleeping 10 seconds ... \n";
    sleep(12);
    $b->getHashRate();
    echo "Sleeping 10 seconds ...\n";
    sleep(12);
    $b->getHashRate();
    echo "Sleeping 10 seconds ...\n";
    sleep(12);
    echo "done sleeping.\n. Ending command :";

    $b->killIt();
}catch (\Exception $e) {
    Log::show("ERROR: ".$e->getCode()." ".$e->getMessage());
}

echo date("r")."# End.";


