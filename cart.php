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
    
<?php
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
	
	if(isset($_POST["btn_logout"])){

		$sql = "DELETE FROM `active`";
		$res = mysqli_query($con,$sql);

		if($res) {
	        session_start();
	        session_destroy();
	        header('location:index.php?logged_out');
		}else {
			echo("not working.");
		}
	}
?>

<?php 
	$total = "0";
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);

	if(isset($_GET["rem"])) {
		$rem = $_GET["rem"];

		$sql = "DELETE FROM `cart` WHERE `crt_id` = '$rem'";
		$res = mysqli_query($con,$sql);

		if($res) {

		}else {
			echo("error");
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
	<link rel="stylesheet" href="cart.css">
</head>
<body>
	<section class="container">
		<div class="nav">
			<div class="image-sec">
				<img src="image/logofinal.jpg" class="img-prop1">
			</div>
			<div class="menu-sec">
		<ul class="ul-menu">
			<li><a href="../index.php" class="navlink">Home</a></li>
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
        <div class="cart_sec">
            <p class="cart_head">Cart Items</p>
			<form method="POST" action="">
            <?php
                ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
                $sql = "SELECT * FROM `cart` INNER JOIN `customer` ON cart.cst_id = customer.cst_id INNER JOIN `items` ON cart.i_id = items.i_id && cart.cst_id = '$uid'";
                $res = mysqli_query($con,$sql);

                if(mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_array($res)) { 
						$total += $row["price"];

						?>
					
                        <div class="item_sec">
						    <div class="img_sec">
						        <img src="image/upload/<?php echo $row["image"];?>" class="img_prop1">
						    </div>
						    <div class="info_sec">
							    <input type="text" name="item_head" class="item_head" value="<?php echo $row["title"];?>"><br>
								<input type="text" name="disp_head" class="disp_head" value="<?php echo $row["disp"];?>"><br>
								<label class="rs">₹</label>
								<input type="text" name="price_head" class="price_head" value="<?php echo $row["price"];?>">
						    </div>
							<div class="btn_sec">
							<a href="cart.php?rem=<?php echo $row["crt_id"];?>" class="btn_remove">Remove</a>
							</div>
						</div>
					
                <?php }
				}else {
					$msg = "<p class=''>Your cart is empty.</p>";
				}
				
            ?>
			<label class="total_head">Total : ₹ </label>
			<input type="text" name="tot_pr" class="tot_pr" disabled="disabled" value="<?php echo $total;?>"><br>
			<p class="payment_head">Payment Method</p>
			<div class="payment_sec">
			<input type="radio" name="inp_check" class="inp_check"><label class="inp_check_head">Debit/Net banking</label><br>
			<input type="radio" name="inp_check" class="inp_check"><label class="inp_check_head">UPI</label><br>
			</div>
			<input type="submit" name="proceed" class="btn_pro" value="Place Order">
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