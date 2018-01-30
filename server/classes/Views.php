<?php

class View {

    static public $data = array();

    static function show($file) {
        $file = preg_replace('/[^a-zA-Z0-9_]/', '', $file);
        require ('../views/'.$file.'.php');

    }

}