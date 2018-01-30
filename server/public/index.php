<?php
try {
    define('CONTROLLER_PATH', '../controllers/');


    if (!isset($_GET['c'])) $_GET['c'] = 'index';
    if (!isset($_GET['a'])) $_GET['a'] = 'index';

    $controller = $_GET['c'];

    $action = $_GET['a'];

    $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
    $action = preg_replace('/[^a-zA-Z0-9]/', '', $action);

    $file = CONTROLLER_PATH . ucfirst($controller) . 'Controller.php';

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require '../classes/Views.php';
        require CONTROLLER_PATH . 'Controller.php';
        $controllerClassName = ucfirst($controller) . 'Controller';
        require CONTROLLER_PATH . $controllerClassName.'.php';
    } else {
        throw new Exception('Controller not found.', 1000);
    }

    $c = new $controllerClassName();
    if (method_exists($c, 'action' . $action)) {
        $m = 'action' . $action;
        $c->$m();
    } else {
        throw new Exception('Action not found.', 1004);
    }


} catch (\Exception $e) {
    die("Error: #".$e->getCode().' : '.$e->getMessage().'<br><pre>'.print_r(debug_backtrace(),1));
}