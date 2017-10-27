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
$sql = "UPDATE `dayoff_change` SET `dayoff_change_status`= '$_REQUEST[action]' ,`approved_user_id`=$_SESSION[ss_user_id],`approved_datetime`=NOW() WHERE dayoff_change_id = $_REQUEST[dayoff_change_id] ";
mysql_query($sql);


if($_REQUEST[action] == 'approve'){
	
	$old = explode('-',$_REQUEST[old_dayoff]);
	$old_d = intval($old[2]);
	$old_m = intval($old[1]);
	$old_y = $old[0];
	
	$new = explode('-',$_REQUEST[new_dayoff]);
	$new_d = intval($new[2]);
	$new_m = intval($new[1]);
	$new_y = $new[0];
	
	// Delete Old Dayoff
	$sql = "select * from dayoff_detail where dayoff_id = '$_REQUEST[user_id]' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m' ";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$ex_all_old = explode(',',$row[dayoff_detail_day]);	
	$txt_old = "";
	for($i=0;$i<count($ex_all_old);$i++){
		if($ex_all_old[$i] != $old_d ){
			$txt_old .= $ex_all_old[$i].",";
		}
	}
	$txt_old = substr($txt_old,0,strlen($txt_old)-1);
	$sql = "UPDATE dayoff_detail SET dayoff_detail_day = '$txt_old' where dayoff_id = '$_REQUEST[user_id]' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m'";
	mysql_query($sql);
	
	// Add New Dayoff
	$sql = "select * from dayoff_detail where dayoff_id = '$_REQUEST[user_id]' AND dayoff_detail_year = '$new_y' AND dayoff_detail_month = '$new_m' ";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$ex_all_new = explode(',',$row[dayoff_detail_day]);	
	$txt_new = "";
	$tmp = 0;
	for($i=0;$i<count($ex_all_new);$i++){
		if($ex_all_old[$i] >$new_d && $tmp == 0){
			$txt_new .= $new_d.",";
			$tmp = 1;
		}
		$txt_new .= $ex_all_new[$i].",";
	}
	$txt_new = substr($txt_new,0,strlen($txt_new)-1);
	$sql = "UPDATE dayoff_detail SET dayoff_detail_day = '$txt_new' where dayoff_id = '$_REQUEST[user_id]' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m'";
	mysql_query($sql);
	
	
	
	
		$sql = "select * from `dayoff_change` Where `dayoff_change_id` = $_REQUEST[dayoff_change_id]  ";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);

		$sql_u = "select * from user where user_id = '$row[user_id]' ";
		$res_u = mysql_query($sql_u);
		$row_u = mysql_fetch_array($res_u);
		$u_name = $row_u['title']."".$row_u['name']." ".$row_u['sname'];
		
		$sql_p = "SELECT * FROM `position` Where position_id = '$row_u[position_id]' ";
		$res_p = mysql_query($sql_p);
		$row_p = mysql_fetch_array($res_p);
		$u_p =  $row_p[position_name];



		// Mail To HR
		$strTo = 'chitchanok@sereneproperty.com';
		$strSubject = "อนุนมัติเปลี่ยนวันหยุด ".$u_name;
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
		  ".$u_name."</td>
		</tr>
			<tr>
		  <td width='40%' align='right'><b>ตำแหน่ง</b></td>
		  <td align='left' style='padding-left:10px;'>".$u_p."</td>
		</tr>
		<tr>
		  <td width='40%' align='right'><b>วันหยุดเดิม</b></td>
		  <td align='left' style='padding-left:10px;'>".date("d / m / ",strtotime($row[old_dayoff])).(date("Y",strtotime($row[old_dayoff]))+543)."</td>
		</tr>
		<tr>
		  <td align='right'><b>วันหยุดใหม่</b></td>
		  <td align='left' style='padding-left:10px;'>".date("d / m / ",strtotime($row[new_dayoff])).(date("Y",strtotime($row[new_dayoff]))+543)."</td>
		</tr>
		<tr>
		  <td align='right'><b>หมายเหตุ</b></td>
		  <td align='left' style='padding-left:10px;'>".$row[dayoff_change_remark]."</td>
		</tr>";
		$strMessage .= "
	  </table>";
	
		$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
		$txt_show = "อนุมัติเปลี่ยนวันหยุด ทำรายการเรียบร้อยแล้ว";



}
$txt_show = "ทำรายการเรียบร้อยแล้ว";
?>
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong><? echo $txt_show; ?></strong></td>
  </tr>
</table>
<meta http-equiv="refresh" content="3; url=apporve_summary_dayoff.php"  />
<? include("footer.php"); // 
?>
