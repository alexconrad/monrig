<?php


class HomeController extends Controller
{

	public function __construct($controller)
	{
		parent::__construct($controller);
	}


	public function actionIndex() {

		$query = /** @lang MySQL */ "SELECT * FROM rigs WHERE user_id = ".($_SESSION['logged_in'] + 0);
		$result = DB::run($query);

		$all = array();
		while ($row = $result->fetch_assoc()) {
			$all[] = $row;
		}

		View::$data = $all;

		View::show('home');
	}

	public function actionAddrig() {

		$callKey = md5(microtime());

		$query = /** @lang MySQL */ "INSERT INTO rigs SET user_id = '".($_SESSION['logged_in'] + 0)."', name = '".DB::esc($_POST['name'])."', CallKey='".$callKey."'";
		DB::run($query);

		header('Location: index.php?c=home&a=index');
		die();

	}
}