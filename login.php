<?php
	include 'connect.php';
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);

	$sl = "SELECT * FROM `active`";
	$cn = mysqli_query($con,$sl);

	if(mysqli_num_rows($cn) > 0) {
		header("location: index.php");
	}else {
	if(isset($_POST["btn_login"])) {

		$user = $_POST["username"];
		$pswd = $_POST["password"];

		$sql = "SELECT * FROM `customer` WHERE `userName` = '$user' && `pswd` = '$pswd'";
		$res = mysqli_query($con,$sql);

		if(mysqli_num_rows($res) > 0) {
			while($row = mysqli_fetch_assoc($res)) {
				$id = $row["cst_id"];
				session_start();
				$_SESSION["cst_session"] = $id;

				$sq = "INSERT INTO `active`(`cst_id`) VALUES ('$id')";
				$cnt = mysqli_query($con,$sq);

				if($cnt) {
					header("location:index.php?userLoggedIn");
				}else {
					echo("user not active");
				}
			}
		} else {
			echo("Wrong username/password.");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Stationary Home</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="font.css">
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<section class="container">
		<div class="nav">
			<div class="image-sec">
				<img src="image/logofinal.jpg" class="img-prop1">
			</div>
			<div class="menu-sec">
		        <ul class="ul-menu">
			        <li><a href="index.php" class="navlink">Home</a></li>
			        <li><a  class="navlink">About</a></li>
		        </ul>
	        </div>
		</div>
        <div class="login_sec">
            <p class="login_head">Login to your account.</p>
            <form action="" method="POST">
                <div class="form_div">
                    <label class="lab_user">Username :</label>
                    <input type="text" name="username" class="inp_user">
                </div>
                <div class="form_div">
                    <label class="lab_user">Password :</label>
                    <input type="password" name="password" class="inp_pswd">
                </div>
                <input type="submit" name="btn_login" class="btn_login" value="Login">
            </form>
            <p class="signUp">Do not have account? <span class="span_su"><a href="signup.php">Sign Up</a></span></p>
        </div>
    </section>
</body>
</html>