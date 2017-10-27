<?php include("header.php");

$sql = "Select * FROM  `user` where `username`= '$_SESSION[ss_username]'  AND `password` = PASSWORD(  '$_REQUEST[old_password]' )  ";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num == 0){
	$error = "รหัสผ่านเดิมไม่ถูกต้อง ระบบไม่สามารถเปลี่ยนรหัสผ่าน";
	echo '<meta http-equiv="refresh" content="3; url=user_change_password.php">';
}else{
	$error = "ระบบได้ทำการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว";
	$sql_query = "UPDATE `user` SET  `password` = PASSWORD(  '$_REQUEST[new_password]' )  Where `user_id` = $_SESSION[ss_user_id]"; 
	mysql_query($sql_query);
	echo '<meta http-equiv="refresh" content="3; url=main.php">';
}
?>
  <table border="0" style="width:100%; margin-top:15px; font-size:40px;" cellspacing="0" cellpadding="0" align="center" class="bordered">
    <tr>
      <td align="center" colspan="2" style=" font-size:60px; letter-spacing:2px;" height="300" valign="middle"><strong><?php echo $error; ?></strong></td>
    </tr>
  </table>
<?php include("footer.php"); ?>
