<?php 
    include '../connect.php' ;
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    if(isset($_POST["submit"])) {

    	$user = $_POST["uname"];
    	$pswd = $_POST["pswd"];
    
    $sql = "SELECT * FROM `admin` WHERE a_name = '$user' && a_pswd = '$pswd'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
    		session_start();
    		$_SESSION["admin_session"] = $row["a_id"];
    		header('location: control.php');
    	}
    }else {
    	header('location: index.php');
    }
}
?> 	
<!DOCTYPE html>
<html>
<head>
	<title>Stationary Home</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="index.css">
</head>
<body>
<section class="container">
<div class="nav">
	<div class="image-sec">
		<img src="../image/logofinal.jpg" class="img-prop1">
	</div>
	<div class="menu-sec">
		<ul class="ul-menu">
			<li>Home</li>
			<li>About</li>
			<!-- <li><i class="far fa-user"></i></li> -->
		</ul>
	</div>
</div>
<div class="login-sec">
	<p class="login head">Welcome Admin</p>
	<form method="POST" action="">
		<div style="border-top: 1px solid lightgray; width: 100%">
			<p class="user-name">User Name</p>
		    <input type="text" name="uname" class="inp-uname">
		</div>
		<div>
			<p class="user-psed">Password</p>
			<input type="text" name="pswd" class="inp-pswd">
		</div>
		<input type="submit" name="submit" class="btn-submit" value="Login">
	</form>
</div>
</div>
</section>
</body>
</html>