<?php


class ReceiveController extends Controller
{

	public function __construct($controller)
	{
		parent::__construct($controller);
	}

	public function actionIndex() {

		print_r($_POST);

		if (!isset($_POST['uid'])) die('no uid');
		if (!isset($_POST['rig'])) die('no rig');
		if (!isset($_POST['payload'])) die('no payload');
		if (!isset($_POST['signature'])) die('no signature');

		$user_id = $_POST['uid'] + 0;
		$rig_id = $_POST['rig'] + 0;
		$payload = $_POST['payload'];
		$receivedSignature = $_POST['signature'];

		$row = DB::getRow(/** @lang MySQL */ "SELECT CallKey FROM rigs WHERE user_id = '".($user_id + 0)."' AND rig_id = '".($rig_id + 0)."'");

		$sCallKey = $row['CallKey'];

		$correctSignature = md5($user_id.$rig_id.$payload.$sCallKey);

		if ($receivedSignature != $correctSignature) {
			die('Bad sign.');
		}

		$report = json_decode($payload, true);
		$temperatures = $report['report']['temperature'];
		$temp1 = $temperatures[0] + 0;
		$temp2 = $temperatures[1] + 0;
		$hash_rate = $report['report']['hashrate'] + 0;

		$query = /** @lang MySQL */ "INSERT INTO rig_data SET rig_id=$rig_id, gpu0_temp={$temp1}, gpu1_temp={$temp2}, hash_rate=$hash_rate, dated=NOW()";
		DB::run($query);

		echo 'OK';


	}


}