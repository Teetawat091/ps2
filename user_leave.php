<?php
include("header.php");
if (!isset($_GET['leave_type'])) {
	// code...
		$lock_yesterday = 0;
}
else{
	if($_GET['leave_type'] == "9B59B6" ||  $_GET['leave_type'] == "2ECC71" || $_GET['leave_type'] == "" ){
		$lock_yesterday = 0;
	}else{
		$lock_yesterday = 1;
	}
}

$lock_yesterday = 0;
?>
<form action="user_leave_doadd.php" method="post" id="form1" enctype="multipart/form-data">
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='left' style='padding-left:25px; font-size:40px;' valign='bottom'><table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td valign="bottom" ><select id="leave_type" name="leave_type" style="width:130px;  border-radius: 3px; height:45px; margin-bottom:0px; margin-top:0px; font-family: 'psl_kittithadaspregular'; font-size:30px;" onchange="changeURL()">
                <option value="2ECC71" <?php if($_GET['leave_type'] == "2ECC71"){?> selected="selected" <?php }?>>ลากิจ</option>
                <option value="9B59B6" <?php if($_GET['leave_type'] == "9B59B6"){?> selected="selected" <?php }?>>ลาป่วย</option>
                <option value="F1C40F" <?php if($_GET['leave_type'] == "F1C40F"){?> selected="selected" <?php }?>>ลาพักร้อน</option>
                <option value="E67E22" <?php if($_GET['leave_type'] == "E67E22"){?> selected="selected" <?php }?>>ลาอื่นๆ</option>
              </select>

              <select  id="time_start"  name="time_start" style="width:130px; border-radius: 3px; height:45px; margin-bottom:0px; margin-top:0px; font-family: 'psl_kittithadaspregular'; font-size:30px;" >
                <option value="0">เวลาเริ่มลา</option>
                <?php
                    for($i=8;$i<18;$i++){
						for($ii=0;$ii<2;$ii++){
							$print = 1;
							if($i== 8 && $ii < 1){
								$print = 0;
							}
							/*
							if($i==17 && $ii > 6){
								$print = 0;
							}*/
							if($i==12 && $ii > 0){
								$print = 0;
							}
							if($print == 1){
							//if($i==8 && $ii==6){$selected = "selected";}else{ $selected = "";}
							echo '<option '.$selected.'  value="'.str_pad($i,2,'0',STR_PAD_LEFT).':'.str_pad(($ii*30),2,'0',STR_PAD_LEFT).'">'.str_pad($i,2,'0',STR_PAD_LEFT).' : '.str_pad(($ii*30),2,'0',STR_PAD_LEFT).' น.</option>';
							}
						}
                    }
                    ?>
              </select>
              <select id="time_end" name="time_end"  style="width:130px; border-radius: 3px; height:45px; margin-bottom:0px; margin-top:0px; font-family: 'psl_kittithadaspregular'; font-size:30px;" >
                <option value="0">จำนวน</option>
                <?php
					for($i=0;$i<9;$i++){
						if($i != 0){
						echo "<option value=".$i.">".$i." ชม</option>";
						}
						if($i != 8){
						echo "<option value=".$i.":30>".$i." ชม 30 นาที</option>";
						}
					}
                    ?>
              </select></td>
          </tr>
        </table></td>
      <td align='right' style='padding-right:30px;'><a class='button large orange' style='text-align:center; height:30px; font-size:30px;' onClick="doSubmit();"><strong>ขออนุมัติลางาน</strong></a></td>
    </tr>
    <?php


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
if (!isset($_GET["m"])) $_GET["m"] = date("n");
if (!isset($_GET["y"])) $_GET["y"] = date("Y");

$currentMonth = $_GET["m"];
$currentYear = $_GET["y"];

$all_color["personal"] = "#9B59B6";
$all_color["sick"] = "#2ECC71";
$all_color["annual"] = "#F1C40F";
$all_color["other"] = "#E67E22";

$sql = "SELECT * FROM `dayleave_detail` WHERE `user_id` = '$_SESSION[ss_user_id]' AND status != 'reject' AND MONTH(  `dayleave_date` ) = $currentMonth AND YEAR(  `dayleave_date` ) = $currentYear ";
$res = $_SESSION['connect']->query($sql);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$all_day_leave[] = date("j",strtotime($row['dayleave_date']));
	$all_color_leave[date("j",strtotime($row['dayleave_date']))] = $all_color[$row['leave_type']];
	$all_status_leave[date("j",strtotime($row['dayleave_date']))] = $row['status'];
}

$sql = "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[ss_user_id]' ";
$res = $_SESSION['connect']->query($sql);
$row = $res->fetch_array(MYSQLI_ASSOC);
$dayoff_id = $row['dayoff_id'];
$approve_user_id = $row["leave_apporve_id"];

$sql = "SELECT * FROM `dayoff_detail` WHERE `dayoff_detail_month` = $currentMonth AND `dayoff_detail_year` = $currentYear AND `dayoff_id` = '$dayoff_id'";
$res = $_SESSION['connect']->query($sql);
$row = $res->fetch_array(MYSQLI_ASSOC);
$all_dayoff = explode(",",$row['dayoff_detail_day']);


$p_year = $currentYear;
$n_year = $currentYear;
$p_month = $currentMonth-1;
$n_month = $currentMonth+1;

if ($p_month == 0 ) {
    $p_month = 12;
    $p_year = $currentYear - 1;
}

if ($n_month == 13 ) {
    $n_month = 1;

    $n_year = $currentYear + 1;
}
$days=array('1'=>"อาทิตย์",'2'=>"จันทร์",'3'=>"อังคาร",'4'=>"พุธ",'5'=>"พฤหัส",'6'=>"ศุกร์",'7'=>"เสาร์");

?>
    <tr>
      <td align='center' colspan='2'><table  border="0" cellpadding="0" cellspacing="0" class="calendared" align="center" >
          <tr align="center">
            <th ><a href="<?php echo $_SERVER["PHP_SELF"] . "?m=". $p_month . "&y=" . $p_year; ?>" ><img src="iconmonstr-arrow-28-icon_left.png" height="25" width="25" /></a> </th>
            <th colspan="5" style="border-left:none;"><span style="font-size:36px;"><B><?php echo $monthNames[$currentMonth-1].'</B></span><B> '.($currentYear+543); ?></B> </th>
            <th style="border-left:none;"><a href="<?php echo $_SERVER["PHP_SELF"]  . "?m=". $n_month . "&y=" . $n_year; ?>"><img src="iconmonstr-arrow-28-icon.png"  height="25" width="25"/></a> </th>
          </tr>
          <tr>
            <?php for($i=1;$i<=7;$i++){ ?>
            <td align="center" width="142" class="nono" ><B><?php echo $days[$i]; ?></B></td>
            <?php } ?>
          </tr>
          <?php
		  //echo date("d-m-y",strtotime("+3 day"));
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
if (!isset($_GET["m"])) $_GET["m"] = date("n");
if (!isset($_GET["y"])) $_GET["y"] = date("Y");

$currentMonth = $_GET["m"];
$currentYear = $_GET["y"];

$p_year = $currentYear;
$n_year = $currentYear;
$p_month = $currentMonth-1;
$n_month = $currentMonth+1;

if ($p_month == 0 ) {
    $p_month = 12;
    $p_year = $currentYear - 1;
}

if ($n_month == 13 ) {
    $n_month = 1;

    $n_year = $currentYear + 1;
}
$days=array('1'=>"อาทิตย์",'2'=>"จันทร์",'3'=>"อังคาร",'4'=>"พุธ",'5'=>"พฤหัส",'6'=>"ศุกร์",'7'=>"เสาร์");
$timestamp = mktime(0,0,0,$currentMonth,1,$currentYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ){
		echo "<tr>";
		$ii = 0;
	}
	$ii++;
    if($i < $startday){
		echo "<td class=nono>&nbsp;</td>";
	} else {
		 $thisday = mktime(0,0,0,$currentMonth,($i - $startday + 1),$currentYear);
		 echo "<td style=' border-radius:0px; ";
		 if($thisday > time() || $lock_yesterday ==0){

		 	 if(in_array(($i - $startday + 1),$all_dayoff)){
			 	echo " background:#A3C6A4; ";
			 }
			 if(in_array(($i - $startday + 1),$all_day_leave)){
			 	echo " background:".$all_color_leave[($i - $startday + 1)];
			 }
			 echo "' ";
			 if( (in_array(($i - $startday + 1),$all_dayoff)) || (in_array(($i - $startday + 1),$all_day_leave))){
					echo " ";
			 }else{
					echo "Onclick=add('".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'); id='td_".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'><input type='checkbox' name='datepicked[]'   style='display:none;' value='". ($i - $startday + 1) . "' id='".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'";
			 }

		 }else{
		 	echo  " background-color:grey'; ";
			echo "' ";
		 }

		 if(in_array(($i - $startday + 1),$all_day_leave)){
		 	if($all_status_leave[($i - $startday + 1)] == "wait"){
		 		echo  "  ><img src='Users-Conference-icon.png' height='40' /></td>";
			}else{
		 		echo  "  ><img src='checked_checkbox.png' height='40' /></td>";
			}
		 }else{
			 echo  "  >".($i - $startday + 1) . "</td>";
		 }
		 // echo  "  >".($i - $startday + 1) . "</td>";
	}
    if(($i % 7) == 6 ){
		echo "</tr>";
	}
	if($i == (($maxday+$startday)-1)){
		if(($ii - 7) != 0){
			for($iii=0;$iii<(7-$ii); $iii++){
			echo "<td class=nono>&nbsp;</td>";
			}
		}
		echo "</tr>";
	}
}//
?>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="padding-left:65px;">เหตุผล<input type="text" name="remark" id="remark" style="width:520px; margin-left:30px;margin-right:20px; margin-bottom:20px; margin-top:10px; font-size:30px;"  /> <input type="file" name="file_attach" id="file_attach" /></td>
    </tr>
</table><div id=t11></div>
  <input type="hidden" name="dayoff_detail_year" value="<? echo $currentYear; ?>"  />
  <input type="hidden" name="dayoff_detail_month" value="<? echo $currentMonth; ?>"  />
  <input type="hidden" name="approve_user_id" value="<? echo $approve_user_id; ?>"  />
</form>
<script>
function add(date){
	if (document.getElementById(date).checked){
		document.getElementById(date).checked = false;
		document.getElementById('td_'+date).style.background = "";
	}else{
		document.getElementById(date).checked = true;
		document.getElementById('td_'+date).style.background = "#"+document.getElementById("leave_type").value;
	}
	var chk = document.getElementsByName('datepicked[]');
    var len = chk.length;
    var has_program = false;
	var chk2 = 0;
    for(i=0;i<len;i++) {
         if(chk[i].checked) {
            has_program = true;
			chk2++;
            //break;
          }
    }
	if(chk2 > 1){
		document.getElementById("time_start").disabled=true;
		document.getElementById("time_end").disabled=true;
	}else{
		document.getElementById("time_start").disabled=false;
		document.getElementById("time_end").disabled=false;
	}
	if(has_program){
		document.getElementById("leave_type").disabled=true;
	}else{
		document.getElementById("leave_type").disabled=false;
	}
}
function doSubmit(){

	var chk = document.getElementsByName('datepicked[]');
    var len = chk.length;
    var has_program = false;
	var chk2 = 0;
	var day_detail = "";
    for(i=0;i<len;i++) {
         if(chk[i].checked) {
            has_program = true;
			chk2++;
			day_detail += chk[i].value+" <? echo $monthNames[$currentMonth-1];?> <? echo ($currentYear+543); ?><br>";
            //break;
          }
    }
	var show_sum = "show";
	if(chk2 == 0){
		show_sum = "none";
		Apprise("<br /><center><strong>กรุณาเลือกวัน</strong></center><br />");
	}
	if(chk2 == 1){
		if(document.getElementById("time_start").value == 0){
			show_sum = "none";
			Apprise("<br /><center><strong>กรุณาเลือก เวลาเริ่มลา</strong></center><br />");
		}else if(document.getElementById("time_end").value == 0){
			show_sum = "none";
			Apprise("<br /><center><strong>กรุณาเลือก จำนวนชั่วโมง</strong></center><br />");
		}
	}
	if(chk2 > 1){
		document.getElementById("time_start").selectedIndex = 0;
		document.getElementById("time_end").selectedIndex = 0;
	}
	if(document.getElementById("remark").value == "" && show_sum == "show"){
		Apprise("<br /><center><strong>กรุณาเลือก กรอกเหตุผล</strong></center><br />");
		show_sum = "none";
	}
	if(show_sum == "show"){
		var leave_type_txt;
		if(document.getElementById("leave_type").value == "9B59B6"){
			leave_type_txt = "ลาป่วย";
		}
		if(document.getElementById("leave_type").value == "2ECC71"){
			leave_type_txt = "ลากิจ";
		}
		if(document.getElementById("leave_type").value == "F1C40F"){
			leave_type_txt = "ลาพักร้อน";
		}
		if(document.getElementById("leave_type").value == "E67E22"){
			leave_type_txt = "ลาอื่นๆ";
		}
		var time_str_txt;
		if(document.getElementById("time_start").value == 0){
			time_str_txt = "-";
		}else{
			time_str_txt = document.getElementById("time_start").value+" น.";
		}
		var day_hour_txt;
		if( chk2 == 1){
			day_hour_txt = document.getElementById("time_end").value+" ชม.";
		}else if(chk2 > 1){
			day_hour_txt = chk2+" วัน ";
		}

		document.getElementById("leave_type_txt").innerHTML = leave_type_txt;
		document.getElementById("time_txt").innerHTML =  time_str_txt;
		document.getElementById("sum_txt").innerHTML =  day_hour_txt;
		document.getElementById("detail_txt").innerHTML =  day_detail;
		document.getElementById("reason_txt").innerHTML =  document.getElementById("remark").value;
		document.getElementById("file_txt").innerHTML =  document.getElementById("file_attach").value;
		document.getElementById("shadow1").style.visibility = 'visible';
	}

}
function doCancelConfirm() {
	document.getElementById("shadow1").style.visibility = 'hidden';
}
function doConfirm() {
	document.getElementById("leave_type").disabled=false;
	document.getElementById("form1").submit();
}
	function changeURL(){
		var lock_yesterday = <? echo  $lock_yesterday; ?>;
		/*if(lock_yesterday == 0){
			if(document.getElementById("leave_type").value != "9B59B6"){
				location.href = "user_leave.php?leave_type="+document.getElementById("leave_type").value+"&m=<? echo $currentMonth; ?>&y=<? echo $currentYear; ?>";
			}
		}
		if(lock_yesterday == 1){
			if(document.getElementById("leave_type").value == "9B59B6"){
				location.href = "user_leave.php?leave_type=9B59B6&m=<? echo $currentMonth; ?>&y=<? echo $currentYear; ?>";
			}
		}*/
		location.href = "user_leave.php?leave_type="+document.getElementById("leave_type").value+"&m=<? echo $currentMonth; ?>&y=<? echo $currentYear; ?>";

	}
</script>

<?php include("footer.php"); ?>
