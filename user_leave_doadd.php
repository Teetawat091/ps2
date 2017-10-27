<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<? 
$monthNames[0]    =    'มกราคม';
$monthNames[1]    =    'กุมภาพันธ์';
$monthNames[2]    =    'มีนาคม';
$monthNames[3]    =    'เมษายน';
$monthNames[4]    =    'พฤษภาคม';
$monthNames[5]    =    'มิถุนายน';
$monthNames[6]    =    'กรกฎาคม';
$monthNames[7]    =    'สิงหาคม';
$monthNames[8]    =    'กันยายน ';
$monthNames[9]    =    'ตุลาคม';
$monthNames[10]    =    'พฤศจิกายน';
$monthNames[11]    =    'ธันวาคม';


if($_REQUEST[leave_type] =="9B59B6"){
	$dleave_type='sick';
	$txt_leave = "ลาป่วย";
}
if($_REQUEST[leave_type] =="2ECC71"){
	$dleave_type='personal';
	$txt_leave = "ลากิจ";
}
if($_REQUEST[leave_type] =="F1C40F"){
	$dleave_type='annual';
	$txt_leave = "ลาพักร้อน";
}
if($_REQUEST[leave_type] =="E67E22"){
	$dleave_type='other';
	$txt_leave = "ลาอื่นๆ";
}
if($_FILES['file_attach']['name']){
	$ext = explode('.',$_FILES['file_attach']['name']);
	$extension = $ext[1];
	$newname = rand(1000,9999)."_".time();
	$full_local_path = 'upload/'.$newname.".".$extension ;
	$sql_path = 'upload/'.$newname.".".$extension ;
	move_uploaded_file($_FILES['file_attach']['tmp_name'], $full_local_path);
}else{
	$full_local_path = "";
}

for($x = 0; $x < count($_POST['datepicked']); $x++ ){
	$datepick .=  $_POST[dayoff_detail_year]."-".str_pad($_POST[dayoff_detail_month], 2, "0", STR_PAD_LEFT)."-".str_pad($_POST['datepicked'][$x], 2, "0", STR_PAD_LEFT).",";
}
$datepick = substr($datepick,0,strlen($datepick)-1);

$sql_query = "Insert Into `dayleave` (`dayleave_id`,`user_id`,`dayleave_type`,`dayleave_remark`,`dayleave_file`,`dayleave_status`,`date_request`,`datetime_entered`,`dayleave_start_time`, `dayleave_hour`)VALUES( 
NULL,'$_SESSION[ss_user_id]','$dleave_type','$_REQUEST[remark]','$full_local_path','no','$datepick',NOW(),'$_REQUEST[time_start]','$_REQUEST[time_end]')"; 
$result = mysql_query($sql_query); 
$d_id = mysql_insert_id();
$txt_day = "";
for($x = 0; $x < count($_POST['datepicked']); $x++ )
{
	$datepick =  $_POST[dayoff_detail_year]."-".$_POST[dayoff_detail_month]."-".$_POST['datepicked'][$x];
	
	$txt_day .= date("d",strtotime($datepick))." ".$monthNames[date("m",strtotime($datepick)) -1]." ".(date("Y",strtotime($datepick))+543);
	$txt_day .= "<br>";
	
	
	$sql_query = "Insert Into `dayleave_detail` (`dayleave_detail_id`,`dayleave_id`,`user_id`, `leave_type`,`dayleave_date`,`approve_user_id`,`status`)VALUES( 
	NULL,'$d_id','$_SESSION[ss_user_id]','$dleave_type','$datepick','$_REQUEST[approve_user_id]','wait')"; 
	$result = mysql_query($sql_query); 
}
if($_REQUEST[time_start] == 0){
	$txt_start = "-";
	$txt_day_count = count($_POST['datepicked'])." วัน";
}else{	
	$txt_start = $_REQUEST[time_start];
	$txt_day_count = $_REQUEST[time_end]." ชม.";
}
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
		$strSubject = "ขออนุมัติลางาน (".$txt_leave.") ".$_SESSION['ss_title']."".$_SESSION['ss_name']." ".$_SESSION['ss_sname'];
		$strHeader .= "MIME-Version: 1.0\r\n";
		$strHeader = "Content-type: text/html; charset=UTF-8\r\n"; // or UTF-8 //
		$strHeader .= "From: Hr Serene<hr@sereneproperty.com>\r\n";
		$strMessage = "
		<table  border='0' cellspacing='5' cellpadding='0' width=450
		align='left' bgcolor='#FFFFFF' style='margin-top: 0px;font-size:24px;'>
		<tr>
		  <td align='center' colspan='2'><strong>รายละเอียด การขออนุมัติลางาน</strong></td>
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
		  <td width='40%' align='right'><b>ประเภทการลา</b></td>
		  <td align='left' style='padding-left:10px;'>".$txt_leave."</td>
		</tr>
		<tr>
		  <td align='right'><b>เวลาเริ่มลา</b></td>
		  <td align='left' style='padding-left:10px;'>".$txt_start."</td>
		</tr>
		<tr>
		  <td align='right'><b>จำนวน</b></td>
		  <td align='left' style='padding-left:10px;'>".$txt_day_count."</td>
		</tr>
		<tr>
		  <td align='right' valign='top'><b>รายละเอียด</b></td>
		  <td align='left' style='padding-left:10px;'>".$txt_day."</td>
		</tr>
		<tr>
		  <td align='right'><b>เหตุผล</b></td>
		  <td align='left' style='padding-left:10px;'>".$_REQUEST[remark]."</td>
		</tr>";
		if($full_local_path != ""){
		$strMessage .= "<tr>
		  <td align='right'><b>ไฟล์แนบ</b></td>
		  <td align='left' style='padding-left:10px;'><a href='http://sereneproperty.com/ps/".$full_local_path."'  target='_blank'>Download</a></td>
		</tr>";
		}
		$strMessage .= "<tr><td colspan=2><hr/></td></tr>
		<tr height=50>
		  <td height=50 align='center' colspan='2' bgcolor='#1abc9c' ><a href=http://sereneproperty.com/ps/confirm.php?code=".$txt_id_confirm." style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>อนุมัติ</strong></a></td>
		</tr>
		<tr height=50>
		  <td height=50 align='center' colspan='2' bgcolor='#e33100'><a  href=http://sereneproperty.com/ps/confirm.php?code=".$txt_id_reject." style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>ไม่อนุมัติ</strong></a></td>
		</tr>
	  </table>";
	
		$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	}


?>
<meta http-equiv="refresh" content="1; url=user_summary_leave.php"  />
<? include("footer.php"); ?>
