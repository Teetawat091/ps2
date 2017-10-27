<?
	session_start();
	$dbhost = "localhost";
	$dbuser = "pongcool_ps";
	$dbpasswd = "ps-12345";
	$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());
	$dbname = "pongcool_ps";
	mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());
	mysql_query("SET NAMES UTF8");
	
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Serene Management System 1.0</title>
<style>
@font-face {
    font-family: 'psl_kittithadaspregular';
    src: url('psl094sp-webfont.eot');
    src: url('psl094sp-webfont.eot?#iefix') format('embedded-opentype'),
         url('psl094sp-webfont.woff') format('woff'),
         url('psl094sp-webfont.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}

* {
	list-style:none;
	margin:0;
	padding:0;
	text-decoration:none;
}
html {
	height:100%;
}
a{
color:#000000;
}
a:hover
{ 
color: #f89d1b;
}

body {
	font-family:'psl_kittithadaspregular',Sans-Serif;
	direction: ltr;
	font-size:30px;
	background-color: #eceff1;
}

#container {
	font:12px;
	margin:auto;
	width:980px;

background-color: #eceff1;
	
}
#header{
text-align:center;
}
.bordered {
	font-family:'psl_kittithadaspregular',Sans-Serif;

	    border-spacing: 0;
    border: solid #ccc 0px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;
	background:#FFF;
	font-size:30px;
}
.bordered input,select{
	font-family:'psl_kittithadaspregular',Sans-Serif;
}
.bordered input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(2); /* IE */
  -moz-transform: scale(2); /* FF */
  -webkit-transform: scale(2); /* Safari and Chrome */
  -o-transform: scale(2); /* Opera */
  padding: 0px;
}    
.bordered td, .bordered th {
    padding: 5px;
}

.bordered th {
    background-color: #FFF;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

</style>
<script language="javascript" type="text/javascript">
	  document.oncontextmenu=RightMouseDown;
	  document.onmousedown = mouseDown; 
	
	  function mouseDown(e) {
		  if (e.which==3 ||e.which==2) {//righClick
		  //alert("Disabled - do whatever you like here..");
			}
	}
	function RightMouseDown() { return false;}
	</script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="apprise-v2.js?time=<? echo time(); ?>"></script>
<link rel="stylesheet" href="apprise-v2.css" type="text/css" />
</head>
<body>

<div id="container" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="main.php"><img src="logo-serene.png" height="100" style="margin-top:20px;" /></a></td>
  </tr>
  <tr>
    <td align="center" ><div style="font-size:22px; font-weight:bold; padding-top:10px; padding-bottom:10px; letter-spacing:2px;">Serene Property Management System 1.0</div></td>
  </tr>
</table>
<div align="center">

<?
	date_default_timezone_set("Asia/Bangkok");

	
	
$txt = base64_decode($_GET[code]);
$code = base64_decode($txt);
$ex = explode(":",$code);
$leave_id = $ex[1];
$leave_ans = $ex[3];
$leave_app_id = $ex[5];
$leave_chk = $ex[2];
// Check CODE
if($leave_chk != "SERENEPROPERTY"){
	exit();
}

// CHECK STATUS
$sql = "select * from `dayoff_change` Where `dayoff_change_id` = $leave_id  ";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$num_rows = mysql_num_rows($res);
if($num_rows == 0){
	$txt_show = "ไม่สามารถทำรายการได้ เนื่องจากไม่พบรายการ";
}
if($row[dayoff_change_status] != 'no'){
	$txt_show = "ไม่สามารถทำรายการได้ เนื่องจากมีการอนุมัติแล้ว";
}
if($row[dayoff_change_status] == 'no'){
	
	
	
		$sql = "UPDATE `dayoff_change` SET `dayoff_change_status`= '$leave_ans' ,`approved_user_id`=$leave_app_id,`approved_datetime`=NOW() WHERE dayoff_change_id = $leave_id ";
		mysql_query($sql);
		
	if($leave_ans == "APPROVE"){
		$sql = "select * from `dayoff_change` Where `dayoff_change_id` = $leave_id  ";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		
		$old_dayoff = $row[old_dayoff];
		$new_dayoff = $row[new_dayoff];
		$dayoff_user_id = $row[user_id];

		
		// Update Dayleave 
		$old = explode('-',$old_dayoff);
		$old_d = intval($old[2]);
		$old_m = intval($old[1]);
		$old_y = $old[0];
		
		$new = explode('-',$new_dayoff);
		$new_d = intval($new[2]);
		$new_m = intval($new[1]);
		$new_y = $new[0];
		
		// Delete Old Dayoff
		$sql = "select * from dayoff_detail where dayoff_id = '$dayoff_user_id' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m' ";
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
		$sql = "UPDATE dayoff_detail SET dayoff_detail_day = '$txt_old' where dayoff_id = '$dayoff_user_id' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m'";
		mysql_query($sql);
		
		// Add New Dayoff
		$sql = "select * from dayoff_detail where dayoff_id = '$dayoff_user_id' AND dayoff_detail_year = '$new_y' AND dayoff_detail_month = '$new_m' ";
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
		
		$sql = "UPDATE dayoff_detail SET dayoff_detail_day = '$txt_new' where dayoff_id = '$dayoff_user_id' AND dayoff_detail_year = '$old_y' AND dayoff_detail_month = '$old_m'";
		mysql_query($sql);
		
		
		$sql = "select * from `dayoff_change` Where `dayoff_change_id` = $leave_id  ";
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
	if($leave_ans == "REJECT"){
		$txt_show = "ไม่อนุมัติเปลี่ยนวันหยุด ทำรายการเรียบร้อยแล้ว";
	}
}

/**/
?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong><? echo $txt_show; ?></strong></td>
  </tr>
</table>
<? include("footer.php"); ?>
