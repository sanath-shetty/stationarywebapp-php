<?php 
    include 'connect.php';
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    
    $sl = "SELECT * FROM `active`";
	$cn = mysqli_query($con,$sl);

	if(mysqli_num_rows($cn) > 0) {
		header("location: index.php");
	}else {

    if(isset($_POST["btn_submit"])) {

        $user = $_POST["inp_user"];
        $email = $_POST["inp_email"];
        $pswd = $_POST["inp_pswd"];
        $sql = "INSERT INTO `customer`(`userName`, `email`, `pswd`) VALUES ('$user','$email','$pswd')";
        $res = mysqli_query($con,$sql);

        if($res) {
            header("location:index.php?userAdded");
        }else{
            echo("error occured");
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
	<link rel="stylesheet" href="signup.css">
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
        <div class="signup_sec">
            <p class="signup_head">Sign up now</p>
            <form method="POST">
                <div class="form_signup">
                    <label class="lab_user">Username :</label>
                    <input type="text" name="inp_user" class="inp_user">
                </div>
                <div class="form_signup">
                    <label class="lab_user">Email :</label>
                    <input type="email" name="inp_email" class="inp_email">
                </div>
                <div class="form_signup">
                    <label class="lab_user">Password :</label>
                    <input type="password" name="inp_pswd" class="inp_pswd">
                </div>
                <input type="submit" name="btn_submit" class="btn_submit" value="Sign up">
            </form>
        </div>
    </section>
</body>
</html>