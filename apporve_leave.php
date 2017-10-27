<? include("header.php"); 
date_default_timezone_set("Asia/Bangkok");
if($_GET[leave_type] == "9B59B6"){
	$lock_yesterday = 0;
}else{
	$lock_yesterday = 1;
}
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

	$all_leave_type["sick"] = "ลาป่วย";
	$all_leave_type["personal"] = "ลากิจ";
	$all_leave_type["annual"] = "ลาพักร้อน";
	$all_leave_type["other"] = "ลาอื่นๆ";

$all_color["personal"] = "#9B59B6";
$all_color["sick"] = "#2ECC71";
$all_color["annual"] = "#F1C40F";
$all_color["other"] = "#E67E22";

$sql = "SELECT * FROM `dayleave_detail` WHERE `dayleave_id` = $_REQUEST[dayleave_id]; ";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_day_leave[] = date("j",strtotime($row[dayleave_date])); 
	$all_color_leave[date("j",strtotime($row[dayleave_date]))] = $all_color[$row[leave_type]]; 
	$all_status_leave[date("j",strtotime($row[dayleave_date]))] = $row[status]; 
	$currentMonth = date("m",strtotime($row[dayleave_date]));
	$currentYear = date("Y",strtotime($row[dayleave_date]));
	$leave_user_id = $row[user_id];
	$leave_user_type = $row[leave_type];
	$date_request .= $row[dayleave_date].",";
}
$date_request = substr($date_request,0,strlen($date_request)-1);


?>
<form action="apporve_leave_update.php" method="post" id="form1" enctype="multipart/form-data">
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='left' style='padding-left:25px; font-size:40px;' valign='bottom'>
	  <?	//echo "<b>".$all_leave_type[$leave_user_type]."</b>";
	  		$sql_user = "SELECT * FROM  `user` where user_id = $leave_user_id";
			$res_user = mysql_query($sql_user);
			$row_user = mysql_fetch_array($res_user);
			echo " ".$row_user[title]."".$row_user[name]." ".$row_user[sname];
			$js_leave_name = $row_user[title]."".$row_user[name]." ".$row_user[sname];
			$js_leave_type = $all_leave_type[$leave_user_type];
			
			$sql_position = "SELECT * FROM  `position` where position_id = $row_user[position_id]";
			$res_postion = mysql_query($sql_position);
			$row_postion = mysql_fetch_array($res_postion);
			$js_position_name = $row_postion[position_name];

	?>
	</td>
      <td align='right' style='padding-right:30px;'>	<a class='button large blue' style='text-align:center; height:30px; font-size:30px; 'onclick="show_detail(<? echo $_REQUEST[dayleave_id]; ?>);"><strong>รายละเอียด</strong></a>
&nbsp;<a class='button large orange' style='text-align:center; height:30px; font-size:30px;' onClick="doSubmit();"><strong>อนุมัติลางาน</strong></a></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><table  border="0" cellpadding="0" cellspacing="0" class="calendared" align="center" >
          <tr align="center">
            <th >&nbsp;</th>
            <th colspan="5" style="border-left:none;"><span style="font-size:36px;"><B><?php echo $monthNames[$currentMonth-1].'</B></span><B> '.($currentYear+543); ?></B> </th>
            <th style="border-left:none;">&nbsp;</th>
          </tr>
          <tr>
            <?php for($i=1;$i<=7;$i++){ ?>
            <td align="center" width="142" class="nono" ><B><?php echo $days[$i]; ?></B></td>
            <?php } ?>
          </tr>
<?
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
	
		 echo "<td style=' border-radius:0px; ";
		 if(in_array(($i - $startday + 1),$all_day_leave)){

			 echo " background:".$all_color_leave[($i - $startday + 1)];
			 echo "' ";
					echo "Onclick=add('".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'); id='td_".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'>
					<input type='checkbox' name='datepicked[]'   style='display:none;' value='". ($i - $startday + 1) . "' id='".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "' checked";
			 
		 }else{
		 	echo  " background-color:grey'; ";	
			echo "' ";
		 }
			echo  "  >".($i - $startday + 1) . "</td>";
		 
		 
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
		<br />
      </td>
    </tr>
</table>
  <input type="hidden" name="dayoff_detail_year" value="<? echo $currentYear; ?>"  />
  <input type="hidden" name="dayoff_detail_month" value="<? echo $currentMonth; ?>"  />
  <input type="hidden" name="dayleave_id" value="<? echo $_REQUEST[dayleave_id]; ?>"  />
    <input type="hidden" name="date_request" value="<? echo $date_request; ?>"  />

</form>
<script>
function add(date){
	if (document.getElementById(date).checked){
		document.getElementById(date).checked = false;
		document.getElementById('td_'+date).style.background = "";
	}else{
		document.getElementById(date).checked = true;
		document.getElementById('td_'+date).style.background = "<? echo $all_color_leave[$all_day_leave[0]];?>";
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
	/*if(chk2 == 0){
		show_sum = "none";
		Apprise("<br /><center><strong>กรุณาเลือกวัน</strong></center><br />");
	}*/
	if(show_sum == "show"){
		var leave_type_txt;
		document.getElementById("leave_name").innerHTML =  "<? echo $js_leave_name; ?>";
		document.getElementById("leave_position").innerHTML =  "<? echo $js_position_name; ?>";
		document.getElementById("leave_type_txt").innerHTML = "<? echo $js_leave_type; ?>";
		<? $sql = "select * FROM  `dayleave` Where dayleave_id = $_REQUEST[dayleave_id];";
			$res = mysql_query($sql);
			$row = mysql_fetch_array($res);
		?>

		document.getElementById("time_txt").innerHTML =  "<? if($row[dayleave_start_time] != ""){ echo $row[dayleave_start_time]; }else { echo "-"; }?>";
		var day_hour_txt;
		if( chk2 == 1){
			day_hour_txt = "<? if($row[dayleave_hour] == ""){ echo "1 วัน";}else{ echo $row[dayleave_hour]." ชม."; } ?>" ;
		}else if(chk2 > 1){
			day_hour_txt = chk2+" วัน ";
		}
		document.getElementById("sum_txt").innerHTML =  day_hour_txt;
		document.getElementById("detail_txt").innerHTML =  day_detail;
		document.getElementById("reason_txt").innerHTML =  "<? echo $row[dayleave_remark]; ?>";
		document.getElementById("file_txt").innerHTML =  "<a href='<? echo $row[dayleave_file]; ?>'  target='_blank'>Download</a>";
		document.getElementById("shadow1").style.visibility = 'visible';
	}
	
}
function doConfirm() {
	document.getElementById("form1").submit();
}
	function changeURL(){
		var lock_yesterday = <? echo  $lock_yesterday; ?>;
		if(lock_yesterday == 0){
			if(document.getElementById("leave_type").value != "9B59B6"){
				location.href = "user_leave.php?leave_type="+document.getElementById("leave_type").value+"&m=<? echo $currentMonth; ?>&y=<? echo $currentYear; ?>";
			}
		}
		if(lock_yesterday == 1){
			if(document.getElementById("leave_type").value == "9B59B6"){ 
				location.href = "user_leave.php?leave_type=9B59B6&m=<? echo $currentMonth; ?>&y=<? echo $currentYear; ?>";
			}
		}
	}
	function createAjax() 
	{
		var request = false;
			try {
				request = new ActiveXObject('Msxml2.XMLHTTP');
			}
			catch (err2) {
				try {
					request = new ActiveXObject('Microsoft.XMLHTTP');
				}
				catch (err3) {
			try {
				request = new XMLHttpRequest();
			}
			catch (err1) 
			{
				request = false;
			}
				}
			}
		return request;
	}

	function show_detail(dayleave_id){
	
			var url = "";
			url =  "dayleave_id="+dayleave_id;
	
			var ajax1=createAjax(); 
			ajax1.onreadystatechange=function(){
				//alert(ajax1.responseText);
				if(ajax1.readyState==4 && ajax1.status==200){
					document.getElementById("shadow2").innerHTML = ajax1.responseText;
					document.getElementById("shadow2").style.visibility = 'visible';
				}
			}
			ajax1.open("POST","ajax_leave_detail.php",true);
			ajax1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
			ajax1.send(url);

	}
	function doCancelConfirm() {
		document.getElementById("shadow1").style.visibility = 'hidden';

		document.getElementById("shadow2").style.visibility = 'hidden';
	}
</script>

<? include("footer.php"); ?>
