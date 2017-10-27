<?
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpasswd = "12345";
		$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generate Insert Update Edit Delete</title>
</head>
<body>
<form action="gen.php" method="post">
	<select name="db">
    	<?
        	$sql = "show databases";
			$res = mysql_query($sql);
			while($row = mysql_fetch_array($res)){
		?>
    	<option><? echo $row[0]; ?></option>
        <?
			}
		?>
    </select>
    <input type="submit" value="Submit"  />
</form>

</body>
</html>