<?php


class IndexController extends Controller  {

	public function __construct($controller)
	{
		parent::__construct($controller);
	}


	public function actionIndex() {
        View::show('index');
    }

    public function actionLogin() {

	    $query = /** @lang MySQL */ "SELECT * FROM users WHERE username = '".DB::esc($_POST['email'])."' AND passwd='".DB::esc($_POST['passwd'])."'";
		$row = DB::getRow($query);

	    if ((is_array($row)) && (isset($row['user_id']))) {
		    $_SESSION['logged_in'] = $row['user_id'];
		    $_SESSION['user_data'] = $row;
		    header("Location: index.php?c=home&a=index");
		    die();
	    }
	    else {
		    die('Login fail.');
	    }

    }

}