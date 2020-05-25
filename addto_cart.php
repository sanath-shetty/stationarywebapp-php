<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1);
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
?>