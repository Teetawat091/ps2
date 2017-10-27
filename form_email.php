<? // header('Content-type: image/jpeg'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Serene Management System 1.0</title>
<style>
@font-face {
    font-family: 'psl_kittithadaspregular';
    src: url('http://sereneproperty.com/ps/psl094sp-webfont.eot');
    src: url('http://sereneproperty.com/ps/psl094sp-webfont.eot?#iefix') format('embedded-opentype'),
         url('http://sereneproperty.com/ps/psl094sp-webfont.woff') format('woff'),
         url('http://sereneproperty.com/ps/psl094sp-webfont.ttf') format('truetype');
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
}
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
    /* Button colors */
	    .green.button {
      background-color: #1abc9c;
    }
      .green.button:hover {
        background-color: #16a085;
      }
    .red.button {
      background-color: #e33100;
    }
      .red.button:hover {
        background-color: #872300;
      }
</style>
</head>
<body>
  <?
  	include("db.php");
	$sql = "select * FROM  `dayleave` Where dayleave_id = 7;";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	
	
	$all_leave_type["sick"] = "ลาป่วย";
	$all_leave_type["personal"] = "ลากิจ";
	$all_leave_type["annual"] = "ลาพักร้อน";
	$all_leave_type["other"] = "ลาอื่นๆ";

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
  <table width="600" border="0" cellspacing="10" cellpadding="0"
	align="left" bgcolor="#FFFFFF" style="margin-top: 0px;">
    <tr>
      <td align="center" colspan="2"> <h1>รายละเอียด การขออนุมัติลางาน</h1></td>
    </tr>
	    <tr>
      <td width="40%" align="right"><b>ชื่อ-สกุล</b></td>
	  <td align="left" style="padding-left:10px;">
	  <? 	$sql_user = "SELECT * FROM  `user` where user_id = $row[user_id]";
			$res_user = mysql_query($sql_user);
			$row_user = mysql_fetch_array($res_user);
			echo $username = $row_user[title]."".$row_user[name]." ".$row_user[sname];
?></td>
    </tr>
	    <tr>
      <td width="40%" align="right"><b>ตำแหน่ง</b></td>
	  <td align="left" style="padding-left:10px;"><? 	
	  		$sql_position = "SELECT * FROM  `position` where position_id = $row_user[position_id]";
			$res_postion = mysql_query($sql_position);
			$row_postion = mysql_fetch_array($res_postion);
			echo $position_name = $row_postion[position_name];
 ?></td>
    </tr>
    <tr>
      <td width="40%" align="right"><b>ประเภทการลา</b></td>
	  <td align="left" style="padding-left:10px;"><? echo $all_leave_type[$row['dayleave_type']]; ?></td>
    </tr>
    <tr>
      <td align="right"><b>เวลาเริ่มลา</b></td>
	  <td align="left" style="padding-left:10px;"><? if($row[dayleave_start_time] != ""){ echo $row[dayleave_start_time]; }else { echo "-"; } ?></td>
    </tr>
    <tr>
      <td align="right"><b>จำนวน</b></td>
	  <td align="left" style="padding-left:10px;"><?  $ex = explode(',' , $row[date_request]); if($row[dayleave_hour] != ""){ echo $row[dayleave_hour]." ชม."; }else { echo count($ex)." วัน";} ?></td>
    </tr>
    <tr>
      <td align="right" valign="top"><b>รายละเอียด</b></td>
	  <td align="left" style="padding-left:10px;"><? 
	  	$ex_app = explode(',' , $row[date_apporve]);
	  	for($x = 0 ; $x < count($ex_app); $x++){
			$date_apporve[] =  strtotime($ex_app[$x]);
		}
	  	for($i=0;$i<count($ex);$i++){
			echo date("d",strtotime($ex[$i]))." ".$monthNames[date("m",strtotime($ex[$i])) -1]." ".(date("Y",strtotime($ex[$i]))+543);
			if($row[dayleave_status] == "no"){ 
				echo " <font color=blue>รอการพิจารณา</font>";
			}else{
				if(in_array(strtotime($ex[$i]),$date_apporve)){
						echo " <font color=green>อนุมัติ</font>";
				}else{
					echo " <font color=red>ไม่อนุมัติ</font>";
				}
			}
			//
			//
			//
			echo "<br>";
		}
	   ?></td>
    </tr>
    <tr>
      <td align="right"><b>เหตุผล</b></td>
	  <td align="left" style="padding-left:10px;"><? echo $row[dayleave_remark]; ?></td>
    </tr>
    <tr>
      <td align="right"><b>ไฟล์แนบ</b></td>
	  <td align="left" style="padding-left:10px;"><a href="<? echo $row[dayleave_file]; ?>"  target="_blank">Download</a></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><a class='button large green' style='text-align:center; height:30px; font-size:30px; width:300px;' onClick="doCancelConfirm();"><strong>อนุมัติ</strong></a></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><a class='button large red' style='text-align:center; height:30px; font-size:30px; width:300px;' onClick="doCancelConfirm();"><strong>ไม่อนุมัติ</strong></a></td>
    </tr>
  </table>
</body>
</html>