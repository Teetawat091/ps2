<? include("header.php"); ?>

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


// CHECK STATUS
$sql = "select * from `dayleave` Where `dayleave_id` = $_REQUEST[dayleave_id] ";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$num_rows = mysql_num_rows($res);
if($num_rows == 0){
	$txt_show = "ไม่สามารถทำรายการได้ เนื่องจากไม่พบรายการ";
}
if($row[dayleave_status] == 'yes'){
	$txt_show = "ไม่สามารถทำรายการได้ เนื่องจากมีการอนุมัติแล้ว";
}
if($row[dayleave_status] == 'no'){

	$ex = explode(",",$_REQUEST[date_request]);
	for($x = 0 ; $x < count($_POST['datepicked']); $x++){
		$datepick[] =  strtotime($_POST[dayoff_detail_year]."-".$_POST[dayoff_detail_month]."-".$_POST['datepicked'][$x]);
	}
	for($x = 0 ; $x < count($ex); $x++){
		// Update Dayleave Detail
		if(in_array(strtotime($ex[$x]),$datepick)){
			// Update status apporve
			$sql = "Update `dayleave_detail` Set `status` = 'apporve' , `approved_user_id` = '$_SESSION[ss_user_id]' , `approved_datetime` =  NOW() Where `dayleave_id` = $_REQUEST[dayleave_id] AND `dayleave_date` = '$ex[$x]' ";
			mysql_query($sql);
			$sql_d_apporve .= $ex[$x].",";
		}else{
			// Update status reject
			$sql = "Update `dayleave_detail` Set `status` = 'reject' , `approved_user_id` = '$_SESSION[ss_user_id]' , `approved_datetime` =  NOW() Where `dayleave_id` = $_REQUEST[dayleave_id] AND `dayleave_date` = '$ex[$x]' ";
			mysql_query($sql);
			$sql_d_reject .= $ex[$x].",";
		}
	}
	
	$sql_d_reject = substr($sql_d_reject,0,strlen($sql_d_reject)-1);
	$sql_d_apporve = substr($sql_d_apporve,0,strlen($sql_d_apporve)-1);
	// Update Dayleave 
	
	$sql = "Update `dayleave` SET  `dayleave_status` = 'yes' , `date_apporve` = '$sql_d_apporve' , `date_reject` = '$sql_d_reject', `approved_user_id` = '$_SESSION[ss_user_id]' , `approved_datetime` = NOW() Where `dayleave_id` = $_REQUEST[dayleave_id]";
	mysql_query($sql);
	$txt_show = "อนุมัติการลา ทำรายการเรียบร้อยแล้ว";
	
		$sql = "select * from `dayleave` Where `dayleave_id` = $_REQUEST[dayleave_id]  ";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		
		if($row[dayleave_type] =="sick"){
			$dleave_type='sick';
			$txt_leave = "ลาป่วย";
		}
		if($row[dayleave_type] =="personal"){
			$dleave_type='personal';
			$txt_leave = "ลากิจ";
		}
		if($row[dayleave_type] =="annual"){
			$dleave_type='annual';
			$txt_leave = "ลาพักร้อน";
		}
		if($row[dayleave_type] =="other"){
			$dleave_type='other';
			$txt_leave = "ลาอื่นๆ";
		}
		
		$sql_u = "select * from user where user_id = '$row[user_id]' ";
		$res_u = mysql_query($sql_u);
		$row_u = mysql_fetch_array($res_u);
		$u_name = $row_u['title']."".$row_u['name']." ".$row_u['sname'];
		
		$sql_p = "SELECT * FROM `position` Where position_id = '$row_u[position_id]' ";
		$res_p = mysql_query($sql_p);
		$row_p = mysql_fetch_array($res_p);
		$u_p =  $row_p[position_name];
		
		$ex_r = explode(',',$row[date_apporve]);
		if($row[dayleave_hour] == ""){
			$txt_start = "-";
			$txt_day_count = count($ex_r)." วัน";
		}else{	
			$txt_start = $row[dayleave_start_time];
			$txt_day_count = $row[dayleave_hour]." ชม.";
		}
		for($x = 0; $x < count($ex_r); $x++ )
		{
			$datepick =  $ex_r[$x];
			$txt_day .= date("d",strtotime($datepick))." ".$monthNames[date("m",strtotime($datepick)) -1]." ".(date("Y",strtotime($datepick))+543);
			$txt_day .= "<br>";
		}

		
		// Mail To HR
		$strTo = 'chitchanok@sereneproperty.com';
		$strSubject = "อนุมัติลางาน (".$txt_leave.") ".$u_name;
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
		  ".$u_name."</td>
		</tr>
		<tr>
		  <td width='40%' align='right'><b>ตำแหน่ง</b></td>
		  <td align='left' style='padding-left:10px;'>".$u_p."</td>
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
		  <td align='left' style='padding-left:10px;'>".$row[dayleave_remark]."</td>
		</tr>";
		if($row[dayleave_file] != ""){
		$strMessage .= "<tr>
		  <td align='right'><b>ไฟล์แนบ</b></td>
		  <td align='left' style='padding-left:10px;'><a href='http://sereneproperty.com/ps/".$row[dayleave_file]."'  target='_blank'>Download</a></td>
		</tr>";
		}
		$strMessage .= "
	  </table>";
	
		$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //

}
?>
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong><? echo $txt_show; ?></strong></td>
  </tr>
</table>

<meta http-equiv="refresh" content="3; url=apporve_summary_leave.php"  />
<? include("footer.php"); ?>
