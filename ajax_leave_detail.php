  <?
  	include("db.php");
	$sql = "select * FROM  `dayleave` Where dayleave_id = $_REQUEST[dayleave_id];";
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
	align="center" bgcolor="#FFFFFF" style="margin-top: 100px;">
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
	  <td align="left" style="padding-left:10px;"><? if($row[dayleave_file] != ""){ ?><a href="<? echo $row[dayleave_file]; ?>"  target="_blank">Download</a><? }else{ ?> - <? } ?></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><a class='button large green' style='text-align:center; height:30px; font-size:30px; width:300px;' onClick="doCancelConfirm();"><strong>ตกลง</strong></a></td>
    </tr>

  </table>
