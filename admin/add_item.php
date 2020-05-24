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

    if(isset($_POST["btn_save"])) {
        $type = $_POST["sel_type"];
        $title = $_POST["inp_title"];
        $price = $_POST["inp_price"];
        $disp = $_POST["inp_disp"];

        $img = $_FILES['file']['name'];
	    $temp = $_FILES['file']['tmp_name'];
        $target_dir = "../image/upload/";
        $target_file = $target_dir . basename($img);

        move_uploaded_file($temp,$target_dir.$img);
        
        $sql = "INSERT INTO `items`(`image`, `type`, `title`, `price`, `disp`) VALUES ('$img','$type','$title','$price','$disp')";
        $result = mysqli_query($con,$sql);

        if($result) {
            $msg = "<p class='msg'>Item added successfully.</p>";
        }else {
            $msg = "<p class='msg'>Error occured.</p>";
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
	<link rel="stylesheet" href="add_item.css">
</head>
<body>
<section class="container">
<div class="nav">
	<div class="image-sec">
		<img src="../image/logofinal.jpg" class="img-prop1">
	</div>
	<div class="menu-sec">
		<ul class="ul-menu">
			<li><a href="../index.php" class="navlink">Home</a></li>
			<li><a href="control.php" class="navlink">Dashboard</a></li>
			<li><a>About</a></li>
			<li id="profile"><i class="far fa-user"></i></li>
		</ul>
	</div>
</div>
<div class="profile active">
	<p class="para">Welcome, <span class="span_uname"><?php echo $user;?></span></p>
	<p class="btn-pswd"><a href="chng_pswd.php">Change Password</a></p>
    <p class="btn-logout"><a href="logout.php">Logout</a></p>
</div>
<?php echo $msg; ?>
<div class="item_sec">
    <form action="" method="POST" class="item-class" enctype="multipart/form-data">
        <p class="item_head">Add Items</p>
        <div>
            <p class="cat_head">Item Category</p>
            <select name="sel_type" id="" class="sel_type">
                <option value="">Select Type</option>
                <?php
                    $sql = "SELECT * FROM `category` ORDER by cat_name ASC";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)) { ?>
                        <option value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                 <?php   } ?>
            </select>
        </div>
        <div>
            <p class="p_file">Select Image</p>
            <input type="file" name="file" id="" class="inp_file">
        </div>
        <div style="display:flex;">
        <div class="box1">
            <p class="p_title">Title for the product</p>
            <input type="text" name="inp_title" id="" class="inp_title">
        </div>
        <div class="box2">
            <p class="p_price">Price</p>
            <input type="text" name="inp_price" id="" class="inp_price">
        </div>
        </div>
        <div>
            <p class="p_disp">Discription</p>
            <textarea  name="inp_disp" id="" class="inp_disp"></textarea>
        </div>
        <input type="submit" name="btn_save" id="" class="btn_additem">
        
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