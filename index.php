<?php
   include 'connect.php';
   session_start();

   if(!isset($_SESSION["cst_session"])) {
	    $sql = "DELETE FROM `active`";
		$res = mysqli_query($con,$sql);
		
		if($res) {
			
		}else {
			echo("Failed");
		}
   }

?>
<?php
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);

	$sql = "SELECT * FROM `active` INNER JOIN `customer` ON active.cst_id = customer.cst_id";
	$res = mysqli_query($con,$sql);

	if(mysqli_num_rows($res) > 0){ 
		while($row = mysqli_fetch_assoc($res)) {
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
ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
if(isset($_GET["ac"])) {
$add = $_GET["ac"];
$sl = "SELECT * FROM `active` LIMIT 1";
$cn = mysqli_query($con,$sl);

if(mysqli_num_rows($cn) > 0) {
    while($row = mysqli_fetch_assoc($cn)) {
    $uid = $row["cst_id"];
    $sql = "INSERT INTO `cart`(`cst_id`, `i_id`) VALUES ('$uid','$add')";
    $res = mysqli_query($con,$sql);

    if($res) {
        header("location: index.php");
    }else{
        echo("Error occured.");
    }
}
}else {
    header("location: login.php");
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
	<link rel="stylesheet" href="index.css">
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
		<div class="banner_sec">
		    <p class="pop_sec">Popular</p>
			<form action="" method="POST">
			<div class="row">
			<?php
			$sql = "SELECT * FROM `items` ORDER BY `i_id` asc";
        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {

			?>
			    <div class="box">
				    <img src="image/upload/<?php echo $row['image'];?>" alt="" class="img_prop">
                    <div class="info_sec">
                        <input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['title'] ?>">
                        <label class="lab_rs">Price : Rs.</label>
                        <input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">
						<input type="text" name="txt_disp" id="" disabled="disabled" value="<?php echo $row['disp'] ?>" class="txt_disp"></input>
                    </div>
                    <a href="index.php?ac=<?php echo $row['i_id']; ?>" class="btn_update">Add to Cart</a>
					<?php 
						ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
						include 'connect.php';
	                    if(isset($_GET["bn"])) {
							$buy = $_GET["bn"];
							$date = date("Y-m-d");
							$total = $row["price"];
							
							$sq = "INSERT INTO `order_history`(`p_date`, `cst_id`, `total`) VALUES ('$date','$_SESSION[cst_session]','$total')";
							echo($sq);
							$result = mysqli_query($con,$sq);
							
							if($result) {
								header('location: orderplaced.php');
							}else{
								echo("failed to insert");
							}
	                    }
                    ?>
                    <a href="index.php?bn=<?php echo $row['i_id']; ?>" class="btn_delete">Buy Now</a>
				</div>
				<?php }
		}
    ?>
			</div>
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