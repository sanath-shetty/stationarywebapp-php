<?php 
	$host='localhost';
	$uname='root';
	$pwd='';
	$db='stationery';

	$con=mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con,$db);
	if ($con->connect_errno) {
		echo "Failed Connection : (" . $con->connect_errno . ")" . $con->connect_error;
	}
?>