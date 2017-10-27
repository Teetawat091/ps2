<?
	session_start();
	$dbhost = "localhost";
	$dbuser = "pongcool_ps";
	//$dbpasswd = "ps-12345";
	$dbpasswd = "";
	$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());
	$dbname = "pongcool_ps";
	mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());
	mysql_query("SET NAMES UTF8");
?>