<?
	include("db.php");
	if($_SESSION['ss_user_id'] == ""){
		exit();
	}
	// UPDATE STATUS
	date_default_timezone_set("Asia/Bangkok");

	/*$next3hour = strtotime("+ 3 hour");
	$sql_3hour = date("Y-m-d H:i:s",$next3hour);
	$sql = "select *  FROM  `dayleave_detail` WHERE  `dayleave_date` <  '$sql_3hour' AND `status` = 'wait' AND `leave_type` != 'sick'  AND `leave_type` != 'personal'  GROUP BY `dayleave_id`";
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
	background-color: #df6105;
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
	background-color: #df6105;
}

#container {
	font:12px;
	margin:auto;
	width:980px;

background-color: #df6105;
	
}
#header{
text-align:center;
}
/* Reset */
.menu,
.menu ul,
.menu li,
.menu a {
	margin: 0;
	padding: 0;
	border: none;
	outline: none;
	z-index:20;
}

/* Menu */
.menu {
	height: 40px;
	width: 980px;

	background: #4c4e5a;
	background: -webkit-linear-gradient(top, #4c4e5a 0%,#2c2d33 100%);
	background: -moz-linear-gradient(top, #4c4e5a 0%,#2c2d33 100%);
	background: -o-linear-gradient(top, #4c4e5a 0%,#2c2d33 100%);
	background: -ms-linear-gradient(top, #4c4e5a 0%,#2c2d33 100%);
	background: linear-gradient(top, #4c4e5a 0%,#2c2d33 100%);

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border-bottom-right-radius: 5px;
	border-bottom-left-radius: 5px;
}

.menu li {
	position: relative;
	list-style: none;
	float: left;
	display: block;
	height: 40px;
	width:196px;
	text-align:center;
	
}

/* Links */

.menu li a {
	display: block;
	padding: 0 0px;
	margin: 8px 0;
	line-height: 28px;
	text-decoration: none;
	
	border-left: 1px solid #393942;
	border-right: 1px solid #4f5058;
	font-family:'psl_kittithadaspregular',Sans-Serif;



	color: #f3f3f3;
	text-shadow: 1px 1px 1px rgba(0,0,0,.6);

	-webkit-transition: color .2s ease-in-out;
	-moz-transition: color .2s ease-in-out;
	-o-transition: color .2s ease-in-out;
	-ms-transition: color .2s ease-in-out;
	transition: color .2s ease-in-out;
}

.menu li:first-child a { border-left: none; }
.menu li:last-child a{ border-right: none; }

.menu li:hover > a { 
/*color: #7c51a0; */
color: #f89d1b;
}

/* Sub Menu */

.menu ul {
	position: absolute;
	top: 40px;
	left: 0;

	opacity: 0;
	
	background: #1f2024;

	-webkit-border-radius: 0 0 5px 5px;
	-moz-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;

	-webkit-transition: opacity .25s ease .1s;
	-moz-transition: opacity .25s ease .1s;
	-o-transition: opacity .25s ease .1s;
	-ms-transition: opacity .25s ease .1s;
	transition: opacity .25s ease .1s;
}

.menu li:hover > ul { opacity: 1; }

.menu ul li {
	height: 0;
	overflow: hidden;
	padding: 0;

	-webkit-transition: height .25s ease .1s;
	-moz-transition: height .25s ease .1s;
	-o-transition: height .25s ease .1s;
	-ms-transition: height .25s ease .1s;
	transition: height .25s ease .1s;
}

.menu li:hover > ul li {
	height: 40px;
	overflow: visible;
	padding: 0;
}

.menu ul li a {
letter-spacing:1px;
font-size:27px;
	width:186px;
	padding: 4px 0 4px 10px;
	text-align:left;
	margin: 0;

	border: none;
	border-bottom: 1px solid #353539;
}

.menu ul li:last-child a { border: none; }
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
<style type="text/css">
  /* Dem old-fashioned button styles */
  .button {
    display: inline-block;
    position: relative;
    overflow: visible;
    
    width: auto;
    padding: 5px 15px 6px;
    border-bottom: 1px solid rgba(0,0,0,0.25);
    
    background: #222;
    color: #fff !important;
    line-height: 1;
    text-decoration: none;
    
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.25);
       -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.25);
            box-shadow: 0 1px 3px rgba(0,0,0,0.25);
    text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
    
    cursor: pointer;
  }
    .button:hover {
      background-color: #111;
    }

    /* Super button */
    .awesome.button {
      padding: 4px 14px 6px;
      border: 1px solid rgba(0,0,0,.25);
      border-bottom-color: rgba(0,0,0,.35);
      -webkit-border-radius: 15px;
         -moz-border-radius: 15px;
              border-radius: 15px;
      font-size: 13px;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
    }
      .large.awesome.button {
        padding: 6px 17px 8px;
        -webkit-border-radius: 18px;
           -moz-border-radius: 18px;
                border-radius: 18px;
      }

    /* Button sizes */
    .large.button {
      font-size: 35px;
      padding: 8px 19px 9px;
	  margin-top:10px;
	  width:250px;
	  letter-spacing:3px;
    }
    .small.button {
      font-size: 11px;
    }

    /* Button colors */
	    .green.button {
      background-color: #1abc9c;
    }
      .green.button:hover {
        background-color: #16a085;
      }
	  	    .flatred.button {
      background-color: #e74c3c;
    }
      .flatred.button:hover {
        background-color: #c0392b;
      }

    .blue.button {
      background-color: #2daebf;
    }
      .blue.button:hover {
        background-color: #007d9a;
      }
    .magenta.button {
      background-color: #a9014b;
    }
      .magenta.button:hover {
        background-color: #630030;
      }
    .red.button {
      background-color: #e33100;
    }
      .red.button:hover {
        background-color: #872300;
      }
    .orange.button {
      background-color: #ff5c00;
    }
      .orange.button:hover {
        background-color: #d45500;
      }
    .yellow.button {
      background-color: #ffb515;
    }
      .yellow.button:hover {
        background-color: #fc9200;
      }
    .secondary.button {
      color: #555 !important;
      text-shadow: 0 1px 1px rgba(255,255,255,0.5);
      border: 1px solid #bbb;
      -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.1);
         -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.1);
              box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
      .secondary.button:hover {
        background-color: #eee;
        color: #444 !important;
        border-color: #999;
      }
	  
#hor-minimalist-b
{
font-family:"Times New Roman", Times, serif;
	font-size: 16px;
	background: #fff;
	width: 920px;
	border-collapse: collapse;
	text-align: left;
	margin-top:10px;
}
#hor-minimalist-b th
{
	font-size: 16px;
	font-weight: bold;
	color: #039;
	background-color:#FFFFFF;
	padding: 10px 8px;
	border-bottom: 2px solid #6678b1;
}
#hor-minimalist-b td
{
	border-bottom: 1px solid #ccc;
	color: #669;
	padding: 6px 8px;
}
#hor-minimalist-b tbody tr:hover td
{
	color: #009;
}

</style>
<style>
.calendared {
	border-spacing: 0;
	width: 920px;
	border: solid #ccc 0px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 0 1px 1px #ccc;
	-moz-box-shadow: 0 1px 1px #ccc;
	box-shadow: 0 1px 1px #ccc;
	background: #FFF;
}
.calendared td:hover {
	cursor: pointer;
	background: #fbf8e9;
	-o-transition: all 0.1s ease-in-out;
	-webkit-transition: all 0.1s ease-in-out;
	-moz-transition: all 0.1s ease-in-out;
	-ms-transition: all 0.1s ease-in-out;
	transition: all 0.1s ease-in-out;
}
td.nono:hover {
	background-color: #FFFFFF;
	cursor: default;
}
.calendared td, .calendared th {
	border-left: 1px solid #ccc;
	border-top: 1px solid #ccc;
	padding: 10px;
	text-align: center;
	height: 40px;
	font-size: 30px;
}
.calendared th {
	background-color: #dce9f9;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
	background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
	background-image: -moz-linear-gradient(top, #ebf3fc, #dce9f9);
	background-image: -ms-linear-gradient(top, #ebf3fc, #dce9f9);
	background-image: -o-linear-gradient(top, #ebf3fc, #dce9f9);
	background-image: linear-gradient(top, #ebf3fc, #dce9f9);
	-webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
	-moz-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
	box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;
	border-top: none;
	text-shadow: 0 1px 0 rgba(255,255,255,.5);
}
.calendared td:first-child, .calendared th:first-child {
	border-left: none;
}
.calendared th:first-child {
	-moz-border-radius: 6px 0 0 0;
	-webkit-border-radius: 6px 0 0 0;
	border-radius: 6px 0 0 0;
}
.calendared th:last-child {
	-moz-border-radius: 0 6px 0 0;
	-webkit-border-radius: 0 6px 0 0;
	border-radius: 0 6px 0 0;
}
.calendared th:only-child {
	-moz-border-radius: 6px 6px 0 0;
	-webkit-border-radius: 6px 6px 0 0;
	border-radius: 6px 6px 0 0;
}
.calendared tr:last-child td:first-child {
	-moz-border-radius: 0 0 0 6px;
	-webkit-border-radius: 0 0 0 6px;
	border-radius: 0 0 0 6px;
}
.calendared tr:last-child td:last-child {
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
<div class="shadow1" id="shadow1" style="position: absolute; z-index: 999; visibility: hidden; width: 100%; height: 100%; background-image:url(bg_popup.png);" align="center">
  <table width="600" border="0" cellspacing="10" cellpadding="0"
	align="center" bgcolor="#FFFFFF" style="margin-top: 100px;">
    <tr>
      <td align="center" colspan="2"> <h1>ยืนยัน การขออนุมัติลางาน</h1></td>
    </tr>
	    <tr>
      <td width="40%" align="right"><b>ชื่อ-สกุล</b></td>
	  <td align="left" style="padding-left:10px;"><span id="leave_name"><? echo $_SESSION[ss_title]."".$_SESSION[ss_name]." ".$_SESSION[ss_sname]; ?></span></td>
    </tr>
	    <tr>
      <td width="40%" align="right"><b>ตำแหน่ง</b></td>
	  <td align="left" style="padding-left:10px;"><span id="leave_position"><? echo $_SESSION[ss_position]; ?></span></td>
    </tr>
    <tr>
      <td width="40%" align="right"><b>ประเภทการลา</b></td>
	  <td align="left" style="padding-left:10px;"><span id="leave_type_txt"></span></td>
    </tr>
    <tr>
      <td align="right"><b>เวลาเริ่มลา</b></td>
	  <td align="left" style="padding-left:10px;"><span id="time_txt"></span></td>
    </tr>
    <tr>
      <td align="right"><b>จำนวน</b></td>
	  <td align="left" style="padding-left:10px;"><span id="sum_txt"></span></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>รายละเอียด</b></td>
	  <td align="left" style="padding-left:10px;"><span id="detail_txt"></span></td>
    </tr>
    <tr>
      <td align="right"><b>เหตุผล</b></td>
	  <td align="left" style="padding-left:10px;"><span id="reason_txt"></span></td>
    </tr>
    <tr>
      <td align="right"><b>ไฟล์แนบ</b></td>
	  <td align="left" style="padding-left:10px;"><span id="file_txt"></span></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><a class='button large green' style='text-align:center; height:30px; font-size:30px; width:300px;' onClick="doConfirm();"><strong>ยืนยัน</strong></a><a class='button large flatred' style='text-align:center; height:30px; font-size:30px;width:300px;' onClick="doCancelConfirm();"><strong>แก้ไข</strong></a></td>
    </tr>

  </table>
</div>
<div class="shadow1" id="shadow2" style="position: absolute; z-index: 999; visibility: hidden; width: 100%; height: 100%; background-image:url(bg_popup.png);" align="center">
</div>

<div id="container" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="main.php"><img src="logo-serene.png" height="100" style="margin-top:20px;" /></a></td>
  </tr>
  <tr>
    <td align="center" ><div style="font-size:22px; font-weight:bold; padding-top:10px; padding-bottom:10px; letter-spacing:2px;">Serene Property Management System 1.0</div></td>
  </tr>
</table>
<ul class="menu">
  <li> <a href="#">ข้อมูลส่วนตัว</a>
    <ul>
      <li><a href="user_change_password.php">เปลี่ยนรหัสผ่าน</a></li>
      <li><a href="user_leave.php">ขออนุมัติลางาน</a></li>
      <li><a href="user_change_dayoff.php">ขออนุมัติเปลี่ยนวันหยุด</a></li>
      <li><a href="user_outgoing.php">ขอออกนอกสถานที่</a></li>
      <li><a href="user_summary_leave.php?year=2017">สรุปวันลา</a></li>
	  <li><a href="user_summary_annual.php">สรุปวันลาพักร้อน</a></li>
	  <li><a href="user_summary_change_dayoff.php">สรุปการเปลี่ยนวันหยุด</a></li>
	  <li><a href="outgoing_summary.php">สรุปออกนอกสถานที่</a></li>
	  
    </ul>
  </li>

  <? if($_SESSION['ss_user_level'] == 'admin' ){ ?>
  <li > <a href="#">งานบุคคล</a>
    <ul  >
      <li ><a href="company.php">ข้อมูลบริษัท</a></li>
      <li><a href="branch.php">ข้อมูลสาขา</a></li>
      <li><a href="department.php">ข้อมูลแผนก</a></li>
      <li><a href="position.php">ข้อมูลตำแหน่งงาน</a></li>
      <li><a href="user.php?status_id=test_approve">ข้อมูลพนักงาน</a></li>
      <li><a href="addlandmarkform.php">เพิ่มสถานที่</a></li>
     <!-- <li><a href="dayoff.php">ข้อมูลชุดวันหยุด</a></li> -->
	  <li><a href="report_leave.php?year=2017">รายงานการลา</a></li>
	  <li><a href="report_leave_user.php?year=2017">รายงานการลารายบุคคล</a></li>
	  <li><a href="report_user_summary_annual.php">รายงานสรุปลาพักร้อน</a></li>
	  <li><a href="report_summary_change_dayoff.php">รายงานปลี่ยนวันหยุด</a></li>
	  <!--<li><a href="report_dayoff.php">รายงานเปลี่ยนวันหยุด</a></li>-->
	  <li><a href="asset_category.php">หมวดหมู่ทรัพย์สิน</a></li>
	  <li><a href="asset_add.php">เพิ่มทรัพย์สิน</a></li>
	  <li><a href="asset.php">สรุปทรัพย์สิน</a></li>
	  <li><a href="asset_user.php">สรุปทรัพย์สินบุคคล</a></li>
      <!--<li><a href="#">ประกาศตำแหน่งงานว่าง</a></li>
        <li><a href="#">ข้อมูลสมัครงาน</a></li>
        <li><a href="#">ข้อมูลทรัพย์สิน</a></li>-->
    </ul>
  </li>
  <? } ?>
  <? if($_SESSION['ss_user_level'] == 'admin_branch' ){ ?>
  <li ><a href="dayoff.php">ข้อมูลชุดวันหยุด</a>
  </li>
    <? } ?>
  <? if($_SESSION['ss_user_level'] == 'manager' || $_SESSION['ss_user_level'] == 'admin' ){ ?>
  <li> <a  href="#">อนุมัติคำขอ</a>
    <ul>
      <li><a href="apporve_summary_leave.php">อนุมัติคำขอลางาน</a></li>
	  <li><a href="apporve_summary_dayoff.php">อนุมัติเปลี่ยนวันหยุด</a></li>
	  <li><a href="report_leave_user_manager.php?year=<? echo date("Y"); ?>">รายงานการลารายบุคคล</a></li>
	  <li><a href="approve_outgoing_notmail.php">คำขอออกนอกสถานที่</a></li>
	  <!--<li><a href="report_dayoff.php">รายงานเปลี่ยนวันหยุด</a></li>
      <li><a href="#">รายงาน</a></li>-->
    </ul>
  </li>
  <? } ?>
    <li> <a href="#">ทั่วไป</a>
    <ul>
      <li><a href="it_job_add.php">แจ้งซ่อมงานไอที</a></li>
      <li><a href="it_job.php">สรุปงานแจ้งซ่อม</a></li>
	  <li><a href="vt/index.php">Company Profile</a>
	  <li><a href="it_manual.php">คู่มือระบบงานไอที</a>
	  </li>
	 <!--<li><a href="asset_check.php">ตรวจสอบทรัพย์สิน</a></li>-->
    </ul>
  </li>
  <li> <a href="logout.php" >ออกจากระบบ</a> </li>
</ul>
<div align="center">
