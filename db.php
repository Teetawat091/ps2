<?php
	session_start();
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpasswd = "";
	$dbname = "pongcool_ps";
	$conn  = new mysqli($dbhost, $dbuser, $dbpasswd,$dbname);
//or die("Could not connect database : Please Connect Internet " . mysqli_error());
	//mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());

	$_SESSION['connect'] = $conn;


	mysqli_set_charset($conn,"utf8");
?>
