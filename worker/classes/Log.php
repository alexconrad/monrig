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

    public static function getBetween($string, $startTag, $endTag) {
        $delimiter = '#';
        $regex = $delimiter . preg_quote($startTag, $delimiter)
            . '(.*?)'
            . preg_quote($endTag, $delimiter)
            . $delimiter
            . 's';
        preg_match($regex,$string,$matches);

        if (isset($matches[1])) {
            return trim($matches[1]);
        }else{
            return false;
        }

    }


}