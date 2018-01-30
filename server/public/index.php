<?php
try {
	date_default_timezone_set('UTC');
	session_start();
    define('CONTROLLER_PATH', '../controllers/');

	// PSR-0 compliant classes are stored in 'classes/'
	require '../classes/AutoloaderServer.php';
	$autoloaderPSR = new \AutoloaderServer('', dirname(__FILE__).DIRECTORY_SEPARATOR.'../classes');
	$autoloaderPSR->register();

    if (!isset($_GET['c'])) $_GET['c'] = 'index';
    if (!isset($_GET['a'])) $_GET['a'] = 'index';

    $controller = $_GET['c'];

    $action = $_GET['a'];

    $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
    $action = preg_replace('/[^a-zA-Z0-9]/', '', $action);

    $file = CONTROLLER_PATH . ucfirst($controller) . 'Controller.php';

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require CONTROLLER_PATH . 'Controller.php';
        $controllerClassName = ucfirst($controller) . 'Controller';
	    /** @noinspection PhpIncludeInspection */
	    require CONTROLLER_PATH . $controllerClassName.'.php';
    } else {
        throw new Exception('Controller not found.', 1000);
    }

    DB::init();
    $c = new $controllerClassName(ucfirst($controller));
    if (method_exists($c, 'action' . $action)) {
        $m = 'action' . $action;
        $c->$m();
    } else {
        throw new Exception('Action not found.', 1004);
    }


} catch (\Exception $e) {
    die("Error: #".$e->getCode().' : '.$e->getMessage().'<br><pre>'.print_r(debug_backtrace(),1));
}