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
    $b = new \Commands\Claymore2();
    $b->startIt();

    echo "Sleeping 15 seconds ... \n";
    sleep(15);

	$payload = new Payload();
	$payload->setTemperature(new \Temperatures\NVIDIASystemManagementInterface());
	$payload->setCommand($b);

	$qwe = $payload->prepareReport();
	print_r($qwe);


	$data = array(
	'uid' =>  1,
	'rig' =>  1,
	'payload' =>  json_encode($qwe),
	);
	$data['signature'] =  md5($data['uid'].$data['rig'].$data['payload'].'7c61cb0fcc042c68484f59bdf2924292');

	$waterfuck = http_build_query($data);

	$debug_var=$waterfuck;echo '<pre style="font: normal 10pt Tahoma;"><hr>';echo 'This debug of $waterfuck is in file :<b>'.__FILE__.'</b> at line <b>'.__LINE__.'</b> (class/method:  <b>$'.__CLASS__.'->&gt;</b>)'."\n";if ((is_array($debug_var)) || (is_object($debug_var))) print_r($debug_var);else echo $debug_var; echo '<hr></pre>';unset($debug_var);


	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://monrig.atami.ro/index.php?c=receive&a=index');
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $waterfuck);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,  true);
	curl_setopt($ch, CURLOPT_TIMEOUT,  30);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$return = curl_exec($ch);

	echo "[".$return."]";

	curl_close($ch);




    sleep(12);
    echo "done sleeping.\n. Ending command :";

    $b->killIt();
}catch (\Exception $e) {
    Log::show("ERROR: ".$e->getCode()." ".$e->getMessage());
}

echo date("r")."# End.";


