<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>ระบบกำลังดำเนินการปรับปรุงข้อมูล</strong></td>
  </tr>
</table>
<?  

$sql = "SELECT * FROM `dayoff_detail` WHERE `dayoff_detail_month` = $_POST[dayoff_detail_month] AND `dayoff_detail_year` = $_POST[dayoff_detail_year] AND `dayoff_id` = $_POST[dayoff_id]";
$res = mysql_query($sql);
$num = mysql_num_rows($res);

$datepick = implode(',',$_POST['datepicked']);
if($num == 0){

	$sql_query = "Insert Into `dayoff_detail` (`dayoff_detail_id`,`dayoff_id`,`dayoff_detail_year`,`dayoff_detail_month`,`dayoff_detail_day`,`datetime_entered`)VALUES( 
	NULL,'$_POST[dayoff_id]','$_REQUEST[dayoff_detail_year]','$_REQUEST[dayoff_detail_month]','$datepick',NOW())"; 
	$result = mysql_query($sql_query); 
	
}else{
	$row = mysql_fetch_array($res);
	$dayoff_detail_id = $row[dayoff_detail_id];
	$sql_query = "UPDATE `dayoff_detail` SET `dayoff_detail_day` = '$datepick' Where `dayoff_detail_id` = $dayoff_detail_id"; 
	$result = mysql_query($sql_query); 
}
if($_SESSION['ss_user_level'] == 'admin_branch'){
 ?>
<meta http-equiv="refresh" content="1; url=dayoff.php"  />
<? 
}else{ 
?>
<meta http-equiv="refresh" content="1; url=user.php?status_id=test_approve"  />
<?
}
include("footer.php"); ?>
