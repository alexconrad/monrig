<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

</head>
<body>

<div class="container">
	<h3>Welcome <?=$_SESSION['user_data']['username']?></h3>
	<hr>
	<h4>Rig: <?=self::$key['name']?></h4>
	<br>

	<?php
	$data      = self::$data;

	if ((!is_array($data['stat'])) || (count($data['stat']) == 0)) {
		echo 'No data.';
	}else{
		?>
		<div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Last communication:</h4>
			<p><?=date("D d M Y H:i", strtotime($data['last_date']))?> (<?=$data['ago']?> ago)</p>
			<h4 class="alert-heading">Last instructions:</h4>
			<?php
			if (isset($data['instructions']))
			{

				foreach ($data['instructions'] as $instruction)
				{
					?>
					<p> <?=($instruction['action']=='1'?'START':'STOP')?>
						asked at <?= date("D d M Y H:i", strtotime($instruction['asked_at'])) ?> (<?=$instruction['ask_ago'] ?> ago)
						<?php if (!empty($instruction['confirmed_at'])) { ?>
						confirmed <?= date("D d M Y H:i", strtotime($instruction['confirmed_at'])) ?> (<?=$instruction['confirmed_ago'] ?> ago)
						<?php } ?>
					</p>
					<?php
				}
			}else{
				echo '<small>No instructions</small>';
			}
			?>
		</div>

		<?php foreach ($data['stat'] as $row) {
			?>
			<div class="row" style="padding-left: 10px;">
				<div class="col-m" style="padding-bottom: 2px;">
					GPU#0 <?=$row['gpu0_temp']?>&deg;C
					GPU#1 <?=$row['gpu1_temp']?>&deg;C
				</div>
				<div class="col-6">
					<?=$row['hash_rate']?>Mh/s
				</div>
				<div class="col-xm">
					<?=$row['dated']?>
				</div>
			</div>
		<?php }
	}
	?>
	<br>
	<br>

	<div class="row"  style="border: 0px dotted #c0c0c0;">
		<div class="col">
			<h3 class="alert-heading">Commands</h3>
			<div class="form-group" style="display: inline-block;float: left;">
				<button type="submit" class="btn btn-primary" style="display: inline;margin-bottom: 4px;" onclick="location.href='index.php?c=stat&a=start&id=<?=self::$key['rig_id']?>';">Start</button>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-danger" style="display: inline;margin-bottom: 4px;" onclick="location.href='index.php?c=stat&a=stop&id=<?=self::$key['rig_id']?>';">Stop</button>
			</div>
		</div>

	</div>


</div>

</body>