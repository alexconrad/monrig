<?php

class StatController extends Controller {

	public function __construct($controller)
	{
		parent::__construct($controller);
	}

	public function actionIndex() {

		if (!isset($_GET['id'])) {
			die('no id');
		}

		$query = /** @lang MySQL */ "SELECT * FROM rigs WHERE rig_id =".($_GET['id'] + 0)." AND user_id = ".($_SESSION['logged_in'] + 0);
		$result = DB::run($query);
		if ($result->num_rows != 1) {
			die('not allowed or rig doesnt exist.');
		}
		$rig = $result->fetch_assoc();
		View::$key = $rig;

		$query = /** @lang MySQL */ "SELECT * FROM rig_instructions WHERE rig_id =".($_GET['id'] + 0)." ORDER BY asked_at DESC LIMIT 5;";
		$result = DB::run($query);

		$all = array();
		while ($row = $result->fetch_assoc()) {

			$row['ask_ago'] = $this->make_ago($row['asked_at']);
			if (!empty($row['confirmed_at'])) {
				$row['confirmed_ago'] = $this->make_ago($row['confirmed_at']);
			}
			$all[] = $row;
		}

		View::$data['instructions'] = $all;


		$query = /** @lang MySQL */ "SELECT * FROM rig_data WHERE rig_id =".($_GET['id'] + 0)." ORDER BY dated DESC LIMIT 20;";
		$result = DB::run($query);

		$all = array();
		$first_row = null;
		while ($row = $result->fetch_assoc()) {
			$all[] = $row;
			if (is_null($first_row)) {
				$first_row = $row;
			}
		}

		View::$data['last_date'] = $first_row['dated'];

/*		$a = new DateTime(date("Y-m-d H:i:s"));
		$b = new DateTime($first_row['dated']);
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


		View::$data['ago'] = implode(' ', $ago);
		*/
		View::$data['ago'] = $this->make_ago($first_row['dated']);


		View::$data['stat'] = $all;

		View::show('stat');
	}

	public function actionStart() {

		/** @TODO validate user id rig id */

		$query = /** @lang MySQL */ "INSERT INTO rig_instructions SET
			rig_id= '".($_GET['id'] + 0)."',
			sent = 0,
			action = 1,
			asked_at =NOW()
		";
		DB::run($query);
		header("Location: index.php?c=stat&a=index&id=".($_GET['id']+0));
		die();
	}
}