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
    $conf = "";
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    if(isset($_GET["dl"])) {
        $del = $_GET["dl"];
        
        $sql = "SELECT * FROM `items` WHERE `i_id` = '$del'";
        $res = mysqli_query($con,$sql);

        while($row = mysqli_fetch_assoc($res)) {
            $conf = "<div class='conf'>
                <p class='delete'>Confirm Delete?</p>
                <form method='POST'>
                <input type='submit' class='confdel' name='confdel' value='Delete'>
                <input type='submit' class='cncl' name='cncl' value='Cancel'>
                </form>
            </div>";
        }
    }
    if(isset($_POST["confdel"])) {
        $sql = "DELETE FROM `items` WHERE `i_id` = '$del'";
        $res = mysqli_query($con,$sql);

        if($res) {
            header("location:view_item.php?deleted");
        }else{
            $msg = "<p class='msg'>Error Occured. Could not delete.</p>";
        }
    }elseif(isset($_POST["cncl"])) {
        header("location:view_item.php?cancelled");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Stationary Home</title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="../font.css">
	<link rel="stylesheet" href="view_item.css">
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
<div>
    <p class="p_item">Item List</p>
    <form action="" method="POST">
    <select name="sel_type" id="" class="sel_type">
        <option value=""></option>
        <?php 
            $sql = "SELECT * FROM `category` ORDER BY `cat_name` asc";
            $result = mysqli_query($con,$sql);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) { ?>

                <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
        <?php   }
            }
        ?>
        
    </select>
    <button class="btn_find">Find</button>
    <?php echo $conf;?>
    <div class="flexbox">
    <?php
    
    if(!empty($_POST["sel_type"])) {
        $type = $_POST["sel_type"];
        $sql = "SELECT * FROM `items` WHERE `type` = '$type'";
        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) { ?>
    <div class="item_sec">
        <img src="../image/upload/<?php echo $row['image'];?>" alt="" class="img_prop">
        <div class="info_sec">
            <input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['title'] ?>">
            <label class="lab_rs">Rs.</label>
            <input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">
            <input type="text" name="txt_disp" id="" disabled="disabled" value="<?php echo $row['disp'] ?>" class="txt_disp"></input>
        </div>
        <a href="update_item.php?ud=<?php echo $row['i_id']; ?>" class="btn_update">Update</a>
        <a href="view_item.php?dl=<?php echo $row['i_id']; ?>" class="btn_delete">Delete</a>
    </div>
    <?php
            }
        }
    } else {
        $sql = "SELECT * FROM `items` ORDER BY `i_id` asc";
        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) { ?>
            <div class="item_sec">
        <img src="../image/upload/<?php echo $row['image'];?>" alt="" class="img_prop">
        <div class="info_sec">
            <input type="text" name="inp_title" id="" class="inp_title" disabled="disabled" value="<?php echo $row['title'] ?>">
            <label class="lab_rs">Price : Rs.</label>
            <input type="number" name="inp_price" id="" class="inp_price" disabled="disabled" value="<?php echo $row['price'] ?>">
            <input type="text" name="txt_disp" id="" disabled="disabled" value="<?php echo $row['disp'] ?>" class="txt_disp"></input>
        </div>
        <a href="update_item.php?ud=<?php echo $row['i_id']; ?>" class="btn_update">Update</a>
        <a href="view_item.php?dl=<?php echo $row['i_id']; ?>" class="btn_delete">Delete</a>
    </div>
    <?php }
        }
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