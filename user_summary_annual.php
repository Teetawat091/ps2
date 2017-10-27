<? include("header.php"); ?>
<script>
	function RelaodPage(){
		window.location.href = "user_summary_leave.php?year="+document.getElementById("year").value;
	}

</script>
<style>
.bordered input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1); /* IE */
  -moz-transform: scale(1); /* FF */
  -webkit-transform: scale(1); /* Safari and Chrome */
  -o-transform: scale(1); /* Opera */
  padding: 0px;
}    
</style>
<form name="form1" action="print_barcode.php" method="post" onsubmit="return doSubmit(this);" target="_blank">
  <input type="hidden" name="all_barocde" id="all_barocde" value=""  />
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td colspan="2" align='left' valign='bottom' style='padding-left:30px; font-size:40px;'> สรุปวันลาพักร้อน</td>
    </tr>
    <?  
if($_SESSION[ss_user_id] != ""){
$all_apporve_name[0] = "-";

$sql = "select * from `user` where user_id != '' "; 
if($_SESSION[ss_user_id] != ""){ $sql .= "  " ;}
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_user_id .= $row[user_id].",";
	$all_apporve_name[$row[user_id]] = $row[name]." ".$row[sname];
	$all_date_start[$row[user_id]] =  $row[date_start];
}
$all_user_id = substr($all_user_id,0,strlen($all_user_id)-1);
// AND `dayleave_date` like '%$_REQUEST[year]%'
$sql = "select * FROM  `dayleave_detail` where `leave_type` like  'annual'  AND user_id in ($_SESSION[ss_user_id])  Group By `dayleave_id`";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_dayleave_id .= $row[dayleave_id].",";
}
$all_dayleave_id = substr($all_dayleave_id,0,strlen($all_dayleave_id)-1);

$sql_query = "select * from `dayleave` where dayleave_id in ($all_dayleave_id) Order By user_id"; 
$result = mysql_query($sql_query); 
$num = mysql_num_rows($result);

$all_status["no"] = "<img src='prohibit.png' height=15  />";
$all_status["reject"] = "<img src='trafficlight red.png' height=15  />";
$all_status["approve"] = "<img src='trafficlight green.png'  height=15  />";


$all_leave_type["sick"] = "ลาป่วย";
$all_leave_type["personal"] = "ลากิจ";
$all_leave_type["annual"] = "ลาพักร้อน";
$all_leave_type["other"] = "ลาอื่นๆ";
?>
    <tr>
      <td align='center'><table id='hor-minimalist-b' >
          <thead>
            <tr>
              <th>ที่.</th>
              <th>ประเภท</th>
              <th align="center">สถานะ</th>
              <th align="center">วันที่ขอลา</th>
              <th align="center">วันที่อนุมัติ</th>
              <th align="center">จน.อนุมัติ</th>
              <th align="center">ผู้อนุมัติ</th>
              <th align="center">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?
$i = 1;
$sum_leave = 0;

function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

  // Check that user date is between start & end
  return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

while($arr = mysql_fetch_array($result)){
if($tmp != $arr['user_id'] && $i > 1 ){
?>
            <tr>
              <td colspan="5" align="right"><em>สรุปวันลาที่อนุมัติ <? echo $all_apporve_name[$tmp]; ?></em></td>
              <td align="right" ><? 
			if(floor(($sum_leave / 480 )) > 0){
				echo floor(($sum_leave / 480 ))." วัน ";
			}
			$hours = floor(($sum_leave % 480 )/ 60);
			$minutes = ($sum_leave % 480 ) % 60;
			if($hours > 0){
				echo $hours." ชม ";
			}
			if($minutes > 0){
				echo $minutes." นาที";
			}
			if($sum_leave  == 0){
				echo "-";
			}
			 ?></td>
              <td align="center">&nbsp;</td>
              <td align="center"><div align=center><a onclick="show_detail(<? echo $arr[0] ?>);"></a></div></td>
            </tr>
            <tr>
              <td colspan="8" style="border-bottom:none;">&nbsp;</td>
            </tr>
            <? 
$sum_leave = 0;

} ?>
            <tr>
              <td><? echo $i; ?></td>
              <td><? echo $all_leave_type[$arr['dayleave_type']]; ?></td>
              <td align="center"><? 
			if($arr['dayleave_status'] == 'no'){
				echo $all_status[$arr['dayleave_status']];
			}else{
				if($arr[date_apporve] != ""){
					echo $all_status["approve"];
				}else{
					echo $all_status["reject"];
				}
			}
			
			 ?></td>
              <td align="center"><? 
				$ex  = explode(",",$arr['date_request']);
				for($a=0;$a<count($ex);$a++){
					echo date("d/m/",strtotime($ex[$a])).(date("y",strtotime($ex[$a]))+43)."<br>";
				}
		 ?></td>
              <td align="center"><? if($arr['approved_user_id'] == 0){ echo "-"; }else{ 
				if($arr[date_apporve] != ""){
					$ex  = explode(",",$arr['date_apporve']);
					for($a=0;$a<count($ex);$a++){
						echo date("d/m/",strtotime($ex[$a])).(date("y",strtotime($ex[$a]))+43)."<br>";
						$all_date_app[] = $ex[$a];
					} 
				}else{
					echo "-";
				}
				}?></td>
              <td align="right" ><? 
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43); 
			if($arr[date_apporve] != ""){
				$ex = explode(',' , $arr[date_request]); 
				if($arr[dayleave_hour] != ""){ 
					if($arr[dayleave_hour] < 8){
						echo $arr[dayleave_hour]." ชม."; 
						$ex_hr = explode(":",$arr[dayleave_hour]);
						$c_min = ($ex_hr[0] * 60);
						$c_min += $ex_hr[1];
						$sum_leave += $c_min;
						$sum_leave_t[$arr['dayleave_type']] += $c_min;
					}else{
						echo count($ex)." วัน";
						$c_min = (count($ex) * 8 * 60);
						$sum_leave += $c_min;
						$sum_leave_t[$arr['dayleave_type']] += $c_min;
					}
				}else { 
					echo count($ex)." วัน";
					$c_min = (count($ex) * 8 * 60);
					$sum_leave += $c_min;
					$sum_leave_t[$arr['dayleave_type']] += $c_min;
				} 
			}else{
				echo "-";
			}
			 ?></td>
              <td align="center"><? echo $all_apporve_name[$arr['approved_user_id']]; ?></td>
              <td align="center"><div align=center><a onclick="show_detail(<? echo $arr[0] ?>);"><img src='page.png' width='20' height="20"   /></a></div></td>
            </tr>
            <? 
		  $tmp = $arr['user_id'];
		  $i++; 
 }


}

 ?>
          </tbody>
        </table>
        <img src="prohibit.png" height=15  /> รอพิจารณา <img src="trafficlight red.png" height=15  /> ไม่อนุมัติ <img src="trafficlight green.png" height=15  /> อนุมัติ <br /></td>
    </tr>
  </table>
<?
$date1 = $all_date_start[$_SESSION['ss_user_id']];
$date2 = date('Y-m-d');

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

//printf("%d years, %d months, %d days\n", $years, $months, $days);
$user_annual[1] = 0;
$user_annual[2] = 7;
$user_annual[3] = 9;
$user_annual[4] = 11;
$user_annual[5] = 13;
$user_annual[6] = 15;
$user_annual[7] = 15;
$user_annual[8] = 15;
$user_annual[9] = 15;
$user_annual[10] = 15;
$user_annual[11] = 15;
$user_annual[12] = 15;
$user_annual[13] = 15;
$user_annual[14] = 15;
$user_annual[15] = 15;
$user_annual[16] = 15;
$user_annual[17] = 15;
$user_annual[18] = 15;
$user_annual[19] = 15;
$user_annual[20] = 15;
$user_annual[21] = 15;
$user_annual[22] = 15;
$user_annual[23] = 15;
$user_annual[24] = 15;
$user_annual[25] = 15;
$user_annual[26] = 15;
$user_annual[27] = 15;
$user_annual[28] = 15;
$user_annual[29] = 15;
$user_annual[30] = 15;
//var_dump($all_date_app);
?>
  <table id='hor-minimalist-b' align="center" class='bordered' >
    <thead>
      <tr>
        <th>ที่.</th>
        <th>รอบปี</th>
        <th align="center">สิทธิการลา(วัน)</th>
        <th align="center">จำนวนวันลา</th>
        <th align="center">คงเหลือ</th>
      </tr>
    </thead>
    <tbody>
	<? 
	$s_date = $all_date_start[$_SESSION['ss_user_id']];
	
	for($i = 1; $i<=ceil($diff / (365*60*60*24)); $i++){ 
	
		$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($s_date)) . " + 1 year"));
	?>
      <tr>
        <td><? echo $i; ?></td>
        <td><? 
		echo date("d/m/",strtotime($s_date)).(date("y",strtotime($s_date))+43);
		echo " - ";
		$ee = date("Y-m-d", strtotime(date("Y-m-d", strtotime($newEndingDate)) . " - 1 day")); 
		echo date("d/m/",strtotime($ee)).(date("y",strtotime($ee))+43);
		?></td>
        <td align="center"><? echo $user_annual[$i]; ?></td>
        <td align="center"><?
			$c = 0;
			for($b=0;$b<count($all_date_app);$b++){
				if(check_in_range($s_date, $ee, $all_date_app[$b])){
					$c++;
				}
			}
			echo $c;
		?></td>
        <td align="center"><? echo  $user_annual[$i] - $c; ?></td>
      </tr>
	 <? 
	 	$s_date = $newEndingDate;
	 } ?>
    </tbody>
  </table>
  <tbody>
</form>
<script>
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
			scroll(0,0);
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
		document.getElementById("shadow2").style.visibility = 'hidden';
	}
	function changeURL(){
		location.href = "report_leave.php?leave_type="+document.getElementById("leave_type").value+"&company_id="+document.getElementById("company_id").value+"&branch_id="+document.getElementById("branch_id").value+"&department_id="+document.getElementById("department_id").value+"&fromdate="+document.getElementById("fromdate").value;
	}
</script>
<? include("footer.php"); ?>
