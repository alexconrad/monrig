<?php

class DB {

	private static $instance;

	/** @var mysqli  */
	private static $mysql;

	private function __construct() {
		try
		{
			self::$mysql = mysqli_connect("127.0.0.1", "monrig", "MGW3i$58as", "monrig");
		}catch (\Exception $e) {
			throw new \Exception('Cannot connect !');
		}
	}

	public static function init() {
		if (is_null(self::$instance)) {
			self::$instance = new DB();
		}
		return self::$instance;
	}

	public static function esc($string) {
		return self::$mysql->real_escape_string($string);
	}

	public static function run($query) {
		return self::$mysql->query($query);
	}

	public static function getRow($query) {

		$prepared = self::$mysql->prepare($query);
		$prepared->execute();

		$result = $prepared->get_result();
		//var_dump($result);

		return $result->fetch_assoc();
	}

}