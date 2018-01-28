<?php

final class Log {

    private static $instance;

    private function __construct() {

    }

    public static function init() {
        if (is_null(self::$instance)) {
            self::$instance = new Log();
        }
        return self::$instance;
    }

    public static function show($string) {
        echo date("r")." #".$string."\n";
    }


}