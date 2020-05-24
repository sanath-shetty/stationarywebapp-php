<?php 
    session_start();
    include 'connect.php' ;

    $sql = "SELECT * FROM `customer` WHERE `cst_id` = '" .$_SESSION["cst_session"]. "'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
            $uid = $_SESSION["cst_session"];
    		$user = $row["userName"];
    	}
    }else {
    	header('location: index.php');
    }
?>

<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
$add = $_GET["ac"];
$sl = "SELECT * FROM `active` WHERE `cst_id` = '" .$_SESSION["cst_session"]. "'";
$cn = mysqli_query($con,$sl);

if(mysqli_num_rows($cn) > 0) {
    
    $sql = "INSERT INTO `cart`(`cst_id`, `i_id`) VALUES ('$uid','$add')";
    $res = mysqli_query($con,$sql);

    if($res) {
        header("location: index.php");
    }else{
        echo("Error occured.");
    }
}else {
    header("location: login.php");
}
?>