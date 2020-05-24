<?php 
    session_start();
    include '../connect.php' ;

    $sql = "SELECT * FROM `admin` WHERE `a_id` = '" .$_SESSION["admin_session"]. "'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
    		$user = $row["a_name"];
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

    	$sql = "SELECT * FROM `admin` WHERE `a_id` = '" .$_SESSION["admin_session"]. "'";
        $result = mysqli_query($con,$sql);

        if (mysqli_num_rows($result) > 0) {
    	    while ($row = mysqli_fetch_assoc($result)) {
    		    $user = $row["a_name"];
    		    if ($row["a_pswd"] == $oldPass && $newPass == $confPass) {
    		    	$sq = "UPDATE `admin` SET `a_pswd`='$newPass' WHERE `a_id` = '" .$_SESSION["admin_session"]. "'";
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
		<img src="../image/logofinal.jpg" class="img-prop1">
	</div>
	<div class="menu-sec">
		<ul class="ul-menu">
			<li>Home</li>
			<li>Dashboard</li>
			<li>About</li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome, <span class="span_uname"><?php echo $user;?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <p class="btn-logout"><a href="logout.php">Logout</a></p>
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