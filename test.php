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
	-webkit-box-shadow: 0 1px 1px #ccc;
	-moz-box-shadow: 0 1px 1px #ccc;
	box-shadow: 0 1px 1px #ccc;
	background: #FFF;
		-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;

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
	-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;
	
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
	font-family:100px;
}
.calendared th:first-child {
	-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;
}
.calendared th:last-child {
	-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;
}
.calendared th:only-child {
	-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;
}
.calendared tr {
	-moz-border-radius: 0 0 0 0;
	-webkit-border-radius: 0 0 0 0;
	border-radius: 0 0 0 0;
}

.calendared td:last-child td:first-child {
	-moz-border-radius: 0px 0px 0px 0px;
	-webkit-border-radius:0px 0px 0px 0px;
	border-radius: 0px 0px 0px 0px;
}
.calendared td:last-child td:last-child {
	-moz-border-radius: 0px 0px 0px 0px;
	-webkit-border-radius: 0px 0px 0px 0px;
	border-radius: 0px 0px 0px 0px;
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
<script type="text/javascript" src="apprise-v2.js?time=1387349255"></script>
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
  <ul class="menu">
    <li> <a >ข้อมูลส่วนตัว</a>
      <ul>
        <li><a href="user_change_password.php">เปลี่ยนรหัสผ่าน</a></li>
        <li><a href="#">ขออนุมัติลางาน</a></li>
        <li><a href="#">สรุปวันลาประจำปี</a></li>
      </ul>
    </li>
    <li> <a >งานไอที</a>
      <ul>
        <li><a href="#">แจ้งซ่อม</a></li>
        <li><a href="#">คู่มือการใช้ระบบ</a></li>
      </ul>
    </li>
    <li> <a >งานบุคคล</a>
      <ul>
        <li><a href="company.php">ข้อมูลบริษัท</a></li>
        <li><a href="branch.php">ข้อมูลสาขา</a></li>
        <li><a href="department.php">ข้อมูลแผนก</a></li>
        <li><a href="position.php">ข้อมูลตำแหน่งงาน</a></li>
        <li><a href="#">ข้อมูลพนักงาน</a></li>
        <li><a href="dayoff.php">ข้อมูลชุดวันหยุด</a></li>
        <!--<li><a href="#">ประกาศตำแหน่งงานว่าง</a></li>
        <li><a href="#">ข้อมูลสมัครงาน</a></li>
        <li><a href="#">ข้อมูลทรัพย์สิน</a></li>-->
      </ul>
    </li>
    <li> <a >อนุมัติคำขอ</a>
      <ul>
        <li><a href="#">อนุมัติคำขอลางาน</a></li>
        <li><a href="#">รายงาน</a></li>
      </ul>
    </li>
    <li> <a href="logout.php" >ออกจากระบบ</a> </li>
  </ul>
  <div align="center">
    <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
      <tr>
        <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ชุดวันหยุด : </strong>Back Office Phuket</td>
        <td align='right' style='padding-right:30px;'><a href=dayoff_add.php class='orange large button' style='text-align:center; height:30px; font-size:30px;'><strong>อัพเดทวันหยุด</strong></a></td>
      </tr>
      <tr>
        <td align='center' colspan='2'><br />
          <table  border="0" cellpadding="0" cellspacing="0" class="calendared" align="center" >
            <tr align="center">
              <th ><a href="/ps/dayoff_detail.php?dayoff_id=1&dayoff_name=Back+Office+Phuket&m=11&y=2013" ><img src="iconmonstr-arrow-28-icon_left.png" height="25" width="25" /></a> </th>
              <th colspan="5" style="border-left:none;"><B>ธันวาคม 2556</B> </th>
              <th style="border-left:none;"><a href="/ps/dayoff_detail.php?dayoff_id=1&dayoff_name=Back+Office+Phuket&m=1&y=2014"><img src="iconmonstr-arrow-28-icon.png"  height="25" width="25"/></a> </th>
            </tr>
            <tr>
              <td align="center" width="142" class="nono" ><B>อาทิตย์</B></td>
              <td align="center" width="142" class="nono" ><B>จันทร์</B></td>
              <td align="center" width="142" class="nono" ><B>อังคาร</B></td>
              <td align="center" width="142" class="nono" ><B>พุธ</B></td>
              <td align="center" width="142" class="nono" ><B>พฤหัส</B></td>
              <td align="center" width="142" class="nono" ><B>ศุกร์</B></td>
              <td align="center" width="142" class="nono" ><B>เสาร์</B></td>
            </tr>
            <tr>
              <td Onclick=add('2013-12-1'); id='td_2013-12-1' ><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-1' id='2013-12-1'  >
                1</td>
              <td Onclick=add('2013-12-2'); id='td_2013-12-2'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-2' id='2013-12-2'  >
                2</td>
              <td Onclick=add('2013-12-3'); id='td_2013-12-3'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-3' id='2013-12-3'  >
                3</td>
              <td Onclick=add('2013-12-4'); id='td_2013-12-4'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-4' id='2013-12-4'  >
                4</td>
              <td Onclick=add('2013-12-5'); id='td_2013-12-5'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-5' id='2013-12-5'  >
                5</td>
              <td Onclick=add('2013-12-6'); id='td_2013-12-6'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-6' id='2013-12-6'  >
                6</td>
              <td Onclick=add('2013-12-7'); id='td_2013-12-7'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-7' id='2013-12-7'  >
                7</td>
            </tr>
            <tr>
              <td Onclick=add('2013-12-8'); id='td_2013-12-8'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-8' id='2013-12-8'  >
                8</td>
              <td Onclick=add('2013-12-9'); id='td_2013-12-9'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-9' id='2013-12-9'  >
                9</td>
              <td Onclick=add('2013-12-10'); id='td_2013-12-10'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-10' id='2013-12-10'  >
                10</td>
              <td Onclick=add('2013-12-11'); id='td_2013-12-11'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-11' id='2013-12-11'  >
                11</td>
              <td Onclick=add('2013-12-12'); id='td_2013-12-12'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-12' id='2013-12-12'  >
                12</td>
              <td Onclick=add('2013-12-13'); id='td_2013-12-13'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-13' id='2013-12-13'  >
                13</td>
              <td Onclick=add('2013-12-14'); id='td_2013-12-14'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-14' id='2013-12-14'  >
                14</td>
            </tr>
            <tr>
              <td Onclick=add('2013-12-15'); id='td_2013-12-15'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-15' id='2013-12-15'  >
                15</td>
              <td Onclick=add('2013-12-16'); id='td_2013-12-16'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-16' id='2013-12-16'  >
                16</td>
              <td Onclick=add('2013-12-17'); id='td_2013-12-17'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-17' id='2013-12-17'  >
                17</td>
              <td Onclick=add('2013-12-18'); id='td_2013-12-18'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-18' id='2013-12-18'  >
                18</td>
              <td Onclick=add('2013-12-19'); id='td_2013-12-19'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-19' id='2013-12-19'  >
                19</td>
              <td Onclick=add('2013-12-20'); id='td_2013-12-20'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-20' id='2013-12-20'  >
                20</td>
              <td Onclick=add('2013-12-21'); id='td_2013-12-21'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-21' id='2013-12-21'  >
                21</td>
            </tr>
            <tr>
              <td Onclick=add('2013-12-22'); id='td_2013-12-22'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-22' id='2013-12-22'  >
                22</td>
              <td Onclick=add('2013-12-23'); id='td_2013-12-23'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-23' id='2013-12-23'  >
                23</td>
              <td Onclick=add('2013-12-24'); id='td_2013-12-24'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-24' id='2013-12-24'  >
                24</td>
              <td Onclick=add('2013-12-25'); id='td_2013-12-25'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-25' id='2013-12-25'  >
                25</td>
              <td Onclick=add('2013-12-26'); id='td_2013-12-26'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-26' id='2013-12-26'  >
                26</td>
              <td Onclick=add('2013-12-27'); id='td_2013-12-27'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-27' id='2013-12-27'  >
                27</td>
              <td Onclick=add('2013-12-28'); id='td_2013-12-28'><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-28' id='2013-12-28'  >
                28</td>
            </tr>
            <tr>
              <td Onclick=add('2013-12-29'); id='td_2013-12-29' class=test><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-29' id='2013-12-29'  >
                29</td>
              <td Onclick=add('2013-12-30'); id='td_2013-12-30' class=test><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-30' id='2013-12-30'  >
                30</td>
              <td Onclick=add('2013-12-31'); id='td_2013-12-31' class=test><input type='checkbox' name='datepicked[]'  style='display:none;' value='2013-12-31' id='2013-12-31'  >
                31</td>
              <td class=nono>&nbsp;</td>
              <td class=nono>&nbsp;</td>
              <td class=nono>&nbsp;</td>
              <td class=nono>&nbsp;</td>
            </tr>
          </table>
          <br />
        </td>
      </tr>
    </table>
    <script>
function add(date){
	if (document.getElementById(date).checked){
		document.getElementById(date).checked = false;
		document.getElementById('td_'+date).style.background = "";
	}else{
		document.getElementById(date).checked = true;
		document.getElementById('td_'+date).style.background = "#A3C6A4";
	}
}
function doSubmit(){
		document.getElementById("form1").submit(); 	
}

</script>
  </div>
</div>
</body>
</html>
