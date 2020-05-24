<?php 
    session_start();
    include 'connect.php' ;

    $sql = "SELECT * FROM `customer` WHERE `cst_id` = '" .$_SESSION["cst_session"]. "'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
    		$user = $row["userName"];
    	}
    }else {
    	header('location: index.php');
    }
?>

<?php
    $msg = "";
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

    if (isset($_POST["btn-submit"])) {
    	$oldPass = $_POST["old-pswd"];
        $newPass = $_POST["new-pswd"];
    	$confPass = $_POST["conf-pswd"];

    	$sql = "SELECT * FROM `customer` WHERE `cst_id` = '" .$_SESSION["cst_session"]. "'";
        $result = mysqli_query($con,$sql);

        if (mysqli_num_rows($result) > 0) {
    	    while ($row = mysqli_fetch_assoc($result)) {
    		    $user = $row["userName"];
    		    if ($row["pswd"] == $oldPass && $newPass == $confPass) {
    		    	$sq = "UPDATE `customer` SET `pswd`='$newPass' WHERE `cst_id` = '" .$_SESSION["cst_session"]. "'";
    		    	$res = mysqli_query($con,$sq);
    		    	if ($res) {
    		    		$msg = "<p class='msg'>Password Successfully Updated.</p>";
    		    	}else {
    		    		$msg = "<p class='msg'>Server Error.</p>";
    		    	}
    		    }else {
    		    	$msg = "<p class='msg'>Passwords do not match.</p>";
    		    }
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
	<link rel="stylesheet" href="chng_pswd.css">
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
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome, <span class="span_uname"><?php echo $user; ?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <form action="" method="POST">
	    <p class="btn-logout" id="logout"><a href="logout.php"><input type="submit" class="btn_logout" name="btn_logout" value="Login"></a></p>
    </form>
</div>
<div class="form-sec">
	<p class="chng-pwsd-head">Change Password</p><br>
	<form method="POST" action="">
		<input type="text" name="old-pswd" class="old-pswd" placeholder="Old Password"><br>
		<input type="text" name="new-pswd" class="new-pswd" placeholder="New Password"><br>
		<input type="text" name="conf-pswd" class="conf-pswd" placeholder="Confirm Password"><br>
		<input type="submit" name="btn-submit" class="btn-submit" value="Change Password">
		<?php echo $msg; ?>
	</form>
</div>
</section>
</body>
<script>
	document.getElementById('profile').addEventListener('click',function() {
		document.querySelector('.profile').classList.toggle('active');
	});
</script>
</html>