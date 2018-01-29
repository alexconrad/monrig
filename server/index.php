<?php
session_start();
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</head>

<body>
<?php
if (isset($_POST['action']))
{

require 'mysql.php';

//$res = mysqli_query($mysqli, "SELECT * FROM users");
//$row = mysqli_fetch_assoc($res);
//print_r($row);
    $email = preg_replace('/[^0-9A-z@.]/i', '', $_POST['email']);
    if ($_POST['action'] == 'signup') {

        $query = "INSERT INTO users SET username='".$mysqli->real_escape_string($email)."', passwd='".$mysqli->real_escape_string($_POST['passwd'])."'";
        $res = mysqli_query($mysqli, $query);
        if ($res === false) {
            die('Error '.$query.':'.$mysqli->error);
        }
        ?>
        <div class="alert alert-success" role="alert">
            Account created.
        </div>
        <?php
    }

    if ($_POST['action'] == 'login') {
        $query = "SELECT user_id FROM users WHERE username='".$mysqli->real_escape_string($email)."' AND passwd='".$mysqli->real_escape_string($_POST['passwd'])."'";
        $res = mysqli_query($mysqli, $query);
        if ($res === false) {
            die('Error '.$query.':'.$mysqli->error);
        }

        $nr = mysqli_num_rows($res);
        if ($nr == 0) {
            ?>
            <div class="alert alert-danger" role="alert">
                Invalid login.
            </div>
            <?php
            die();
        }

        $row = mysqli_fetch_assoc($res);

        $_SESSION['user_id'] = $row['user_id'];

        header("Location: welcome.php");
        die();

        ?>
        <div class="alert alert-success" role="alert">
            You are logged in. user_id = <?=$row['user_id']?>
            <br>
            <a href="welcome.php">Proceeding...</a>

        </div>
        <?php

        die();//qwe 123
    }

}
?>

<div class="container" style="width: 600px;padding: 20px;">
<div class="row"  style="border: 1px dotted #c0c0c0;">
    <div class="col">
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="signup">
            <h4 class="alert-heading">Signup</h4>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="passwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <div class="col">

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="login">
        <h4 class="alert-heading">Login</h4>

        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="passwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    </div>

</div>
</div>

</body>