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

	/*$next3hour = strtotime("+ 3 hour");
	$sql_3hour = date("Y-m-d H:i:s",$next3hour);
	$sql = "select *  FROM  `dayleave_detail` WHERE  `dayleave_date` <  '$sql_3hour' AND `status` = 'wait'  AND `leave_type` != 'sick' AND `leave_type` != 'personal' GROUP BY `dayleave_id`";
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res)){
	
		$sql_l_detail = "select * from `dayleave` Where `dayleave_id` = $row[dayleave_id]  ";
		$res_l_detail = mysql_query($sql_l_detail);
		$row_l_detial = mysql_fetch_array($res_l_detail);
		$all_day_request = $row_l_detial[date_request];
		
		$sql_detail = "Update `dayleave` SET  `dayleave_status` = 'yes' , `date_reject` = '$all_day_request', `approved_user_id` = '0' , `approved_datetime` = NOW() Where `dayleave_id` = $row_l_detial[dayleave_id]";
		mysql_query($sql_detail);
		
		$sql_detail = "Update `dayleave_detail` Set `status` = 'reject' , `approved_user_id` = '0' , `approved_datetime` =  NOW() Where `dayleave_id` = $row_l_detial[dayleave_id]";
		mysql_query($sql_detail);
	}*/
	
	
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
$sql = "select * from `dayleave` Where `dayleave_id` = $leave_id  ";
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
	
	$all_day_request = $row[date_request];
	// Update Dayleave 
	if($leave_ans == "APPROVE"){
		$sql = "Update `dayleave` SET  `dayleave_status` = 'yes' , `date_apporve` = '$all_day_request' , `approved_user_id` = '$leave_app_id' , `approved_datetime` = NOW() Where `dayleave_id` = $leave_id";
		mysql_query($sql);
		
		$sql = "Update `dayleave_detail` Set `status` = 'apporve' , `approved_user_id` = '$leave_app_id' , `approved_datetime` =  NOW() Where `dayleave_id` = $leave_id";
		mysql_query($sql);
		$txt_show = "อนุมัติการลา ทำรายการเรียบร้อยแล้ว";
		
		$sql = "select * from `dayleave` Where `dayleave_id` = $leave_id  ";
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
	if($leave_ans == "REJECT"){
		$sql = "Update `dayleave` SET  `dayleave_status` = 'yes' , `date_reject` = '$all_day_request', `approved_user_id` = '$leave_app_id' , `approved_datetime` = NOW() Where `dayleave_id` = $leave_id";
		mysql_query($sql);
		
		$sql = "Update `dayleave_detail` Set `status` = 'reject' , `approved_user_id` = '$leave_app_id' , `approved_datetime` =  NOW() Where `dayleave_id` = $leave_id";
		mysql_query($sql);
		$txt_show = "ไม่อนุมัติการลา ทำรายการเรียบร้อยแล้ว";

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
