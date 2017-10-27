<?
	session_start();
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpasswd = "5555";
	$dbname = "pongcool_ps";
	$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());	
	mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());
	
	mysql_query("SET NAMES UTF8");
?>