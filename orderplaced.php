<?php
    include 'connect.php';
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);

	$sql = "SELECT * FROM `active` INNER JOIN `customer` ON active.cst_id = customer.cst_id";
	$res = mysqli_query($con,$sql);

	if(mysqli_num_rows($res) > 0){ 
		while($row = mysqli_fetch_assoc($res)) {
			$uid = $row["cst_id"];
			$user = $row["userName"];
			?>
	<style>
		#login {
			display:none;
		}
	</style>
	<?php }
    }else{ ?>
		<style>
			#profile {
				display:none;
			}
			#cart {
				display:none;
			}
		</style>
	<?php }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stationary Home</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="font.css">
	<link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="orderplaced.css">
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
			<li id="cart"><a href="cart.php" class="navlink">Cart</a></li>
			<li><a  class="navlink">About</a></li>
			<li  id="login"><a href="login.php" class="navlink">Login</a></li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	        </div>
		</div>
		<div class="profile active">
	        <p class="para">Welcome, <span class="span_uname"><?php echo $user; ?></span></p>
			<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
			<form action="" method="POST">
				<p class="btn-logout" id="logout"><a href="logout.php"><input type="submit" class="btn_logout" name="btn_logout" value="Logout"></a></p>
			</form>
        </div>
        <div class="orderplaced-msg">
        <h1>Order has been placed.</h1>
        <a href="index.php" class="btn-home">Continue Shopping</a>
        </div>
    </section>
</body>
<script>
	document.getElementById('profile').addEventListener('click',function() {
		document.querySelector('.profile').classList.toggle('active');
	});
</script>
</html>