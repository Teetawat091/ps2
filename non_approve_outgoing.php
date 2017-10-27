<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta content="initial-scale=1.0">
</head>
<body align="center">

	<?php 
//var_dump($_GET);

$dbhost = "localhost";
	$dbuser = "root";
	$dbpasswd = "5555";
	$dbname = "pongcool_ps";
	$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());	
	mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());
	
	mysql_query("SET NAMES UTF8");

	echo '<br>';
	$sql = "UPDATE user_outgoing SET status = 'cancle' WHERE user_outgoing.user_outgoing_id =".$_GET["goid"];
	//echo $sql;
	$result = mysql_query($sql);

	?>

<img src="logo-serene.png">
	<br><br>

	<h1>ไม่อนุมัติคำขอออกนอกสถานที่</h1>

</body>
</html>

<?php if (isset($_GET['cancle'])) { ?>
	<script> 
	window.setTimeout('window.close()',1500);
</script>

<?php }
else{ ?>
	<script type="text/javascript">
		window.setTimeout('window.history.back();',1500); 
	</script>
<?php }
 ?>
