<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

</head>
<body>

<div class="container">
	<h3>Welcome <?=$_SESSION['user_data']['username']?></h3>
	<hr>
	<h4>Your rigs:</h4>
	<br>

	<?php
	$data      = self::$data;

	foreach ($data as $row) {
	?>
	<div class="row" style="padding-left: 10px;">
		<div class="col-m" style="padding-bottom: 2px;"><button type="submit" class="btn btn-primary" style="width: 120px;" onclick="location.href='index.php?c=stat&a=index&id=<?=$row['rig_id']?>';"><?php
				echo substr($row['name'],0,12);
				?></button></div>
		<div class="col-6">
			<input type="text" value="<?=$row['CallKey']?>" class="form-control" onclick="this.select();">
		</div>
		<div class="col-xm">
			<a href="#" style="color: red;">X</a>
		</div>
	</div>
	<?php } ?>

	<br>
	<br>

	<div class="row"  style="border: 0px dotted #c0c0c0;">
		<div class="col">
			<form action="index.php?c=home&a=addrig" method="post">
				<h3 class="alert-heading">Add rig</h3>
				<div class="form-group" style="display: inline-block;float: left;">
					<input name="name" type="text" class="form-control" id="RigName" placeholder="Name your rig" style="width: 190px;display: inline;" maxlength="12">
					<button type="submit" class="btn btn-primary" style="display: inline;margin-bottom: 4px;">Add</button>
				</div>
			</form>
		</div>

	</div>


</div>

</body>