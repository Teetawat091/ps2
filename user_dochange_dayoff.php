<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<? 

	$ex = explode('/',$_POST[my]);
	$old_day = date('Y-m-d',strtotime($ex[1]."-".$ex[0]."-".$_POST[dd]));
	
	$ex = explode('/',$_POST[n_my]);
	$new_day = date('Y-m-d',strtotime($ex[1]."-".$ex[0]."-".$_POST[n_dd]));
	
	$sql = "INSERT INTO `dayoff_change` (`dayoff_change_id`, `user_id`, `old_dayoff`, `new_dayoff`, `dayoff_change_remark`, `dayoff_change_status`, `approve_user_id`, `datetime_entered`) VALUES (NULL, '$_SESSION[ss_user_id]', '$old_day', '$new_day', '$_POST[dayoff_change_remark]', 'no', '$_POST[approve_user_id]', NOW());";
	mysql_query($sql);
	$d_id = mysql_insert_id();
	
	// Mail
	$search = array('[', ']');
	$replce   = array('', '');
	$only_id  = str_replace($search, $replce, $_REQUEST[approve_user_id]);
	$sql = "select * from user where user_id in ($only_id)";
	$res = mysql_query($sql);
	while($row =mysql_fetch_array($res)){
		$txt_en = base64_encode("ID:".$d_id.":SERENEPROPERTY:APPROVE:APP_ID:".$row[user_id]);
		$txt_id_confirm = base64_encode($txt_en);
		
		$txt_en = base64_encode("ID:".$d_id.":SERENEPROPERTY:REJECT:APP_ID:".$row[user_id]);
		$txt_id_reject = base64_encode($txt_en);
	
		$strTo = $row[email];
		$strSubject = "ขออนุนมัติเปลี่ยนวันหยุด  ".$_SESSION['ss_title']."".$_SESSION['ss_name']." ".$_SESSION['ss_sname'];
		$strHeader .= "MIME-Version: 1.0\r\n";
		$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
		$strHeader .= "From: Hr Serene<hr@sereneproperty.com>\r\n";
		$strMessage = "
		<table  border='0' cellspacing='5' cellpadding='0' width=450
		align='left' bgcolor='#FFFFFF' style='margin-top: 0px;font-size:24px;'>
		<tr>
		  <td align='center' colspan='2'><strong>รายละเอียด ขออนุนมัติเปลี่ยนวันหยุด</strong></td>
		</tr>
			<tr><td colspan=2><hr/></td></tr>
	
			<tr>
		  <td width='40%' align='right'><b>ชื่อ-สกุล</b></td>
		  <td align='left' style='padding-left:10px;'>
		  ".$_SESSION['ss_title']."".$_SESSION['ss_name']." ".$_SESSION['ss_sname']."</td>
		</tr>
			<tr>
		  <td width='40%' align='right'><b>ตำแหน่ง</b></td>
		  <td align='left' style='padding-left:10px;'>".$_SESSION[ss_position]."</td>
		</tr>
		<tr>
		  <td width='40%' align='right'><b>วันหยุดเดิม</b></td>
		  <td align='left' style='padding-left:10px;'>".date("d / m / ",strtotime($old_day)).(date("Y",strtotime($old_day))+543)."</td>
		</tr>
		<tr>
		  <td align='right'><b>วันหยุดใหม่</b></td>
		  <td align='left' style='padding-left:10px;'>".date("d / m / ",strtotime($new_day)).(date("Y",strtotime($new_day))+543)."</td>
		</tr>
		<tr>
		  <td align='right'><b>หมายเหตุ</b></td>
		  <td align='left' style='padding-left:10px;'>".$_POST[dayoff_change_remark]."</td>
		</tr>";
		$strMessage .= "<tr><td colspan=2><hr/></td></tr>
		<tr height=50>
		  <td height=50 align='center' colspan='2' bgcolor='#1abc9c' ><a href=http://sereneproperty.com/ps/confirm_dayoff.php?code=".$txt_id_confirm." style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>อนุมัติ</strong></a></td>
		</tr>
		<tr height=50>
		  <td height=50 align='center' colspan='2' bgcolor='#e33100'><a  href=http://sereneproperty.com/ps/confirm_dayoff.php?code=".$txt_id_reject." style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>ไม่อนุมัติ</strong></a></td>
		</tr>
	  </table>";
	
		$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
}
 ?>
<meta http-equiv="refresh" content="3; url=user_summary_change_dayoff.php"  />
<? include("footer.php");  ?>
