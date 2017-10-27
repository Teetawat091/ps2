<? include("header.php"); ?>
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>  <tr>    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>แจ้งซ่อมงานไอที :)</strong></td><td align='right' style='padding-right:30px;'></td></tr><?  
$sql = "select * from user";
$res = mysql_query($sql);
while($row= mysql_fetch_array($res)){
	$u_name[$row[user_id]] = $row[name]." ".$row[sname];
}

$sql_query = "select * from `it_job`"; 
$result = mysql_query($sql_query); 

$all_pio['high'] = "<font color=red>สูง</font>";
$all_pio['medium'] = "<font color=blue>ปานกลาง</font>";
$all_pio['low'] = "<font color=green>ต่ำ</font>";


$job_status['send'] = "<font color=red>ส่ง</font>";
$job_status['receive'] = "<font color=blue>รับเรื่อง</font>";
$job_status['close'] = "<font color=green>ปิดงาน</font>";

?>  
<tr><td align='center' colspan='2'><table id='hor-minimalist-b' > <thead><tr> 
		<th>No.</th> 
		<th>หัวเรื่อง</th> 
		<!--<th>ความสำคัญ</th> -->
		<th>ประเภท</th> 
		<th>ผู้แจ้ง</th> 
		<th>สถานะ</th> 
		<th>วันที่แจ้ง</th> 
		<th>วันที่ปิดงาน</th>
		<!--<th>&nbsp;</th> -->
		</tr></thead><tbody>

<?
$i = 1;
while($arr = mysql_fetch_array($result)){
?> 
	<tr>
		<td><? echo $i; ?></td> 
		<td><? echo $arr['job_title']; ?></td> 
		<!--<td><? echo $all_pio[$arr['job_piority']]; ?></td> -->
		<td><? echo $arr['job_type']; ?></td> 
		<td><? echo $u_name[$arr['job_sender_id']]; ?></td> 
		<td><? echo $job_status[$arr['job_status']]; ?></td>
		<td><? echo $arr['job_datetime_entered']; ?></td> 
		<td><? echo $arr['job_datetime_close']; ?></td> 
		<!--<td><div align=center><a href=it_job_edit.php?job_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td> -->
		</tr>
<? $i++; 
 } ?>
</tbody></table>
<? include("footer.php"); ?>
