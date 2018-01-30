<?php


class Controller {

	public $currentController;

	public function __construct($controller)
	{

		if (strtolower($controller) == 'index') {
			return true;
		}

		if (strtolower($controller) == 'receive') {
			return true;
		}

		if (isset($_SESSION['logged_in'])) {
			return true;
		}

		die('not allowed'); //yeah yea

	}

	protected function make_ago($date) {

		$a = new DateTime(date("Y-m-d H:i:s"));
		$b = new DateTime($date);
		$oDateInterval = date_diff($a, $b);

		$days = $oDateInterval->d;
		$hours = $oDateInterval->h;
		$minutes = $oDateInterval->i;
		$seconds = $oDateInterval->s;

		$ago = array();
		if ($days > 0) $ago[] = $days.'d';
		if ($hours > 0) $ago[] = $hours.'h';
		if ($minutes > 0) $ago[] = $minutes.'m';
		if ($seconds > 0) $ago[] = $seconds.'s';

		return implode(' ', $ago);

	}

}