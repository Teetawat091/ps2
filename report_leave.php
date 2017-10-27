<? include("header.php"); 
	error_reporting(0);
	$marr['01'] = "มกราคม";
	$marr['02'] = "กุมภาพันธ์";
	$marr['03'] = "มีนาคม";
	$marr['04'] = "เมษายน";
	$marr['05'] = "พฤษภาคม";
	$marr['06'] = "มิถุนายน";
	$marr['07'] = "กรกฎาคม";
	$marr['08'] = "สิงหาคม";
	$marr['09'] = "กันยายน";
	$marr['10'] = "ตุลาคม";
	$marr['11'] = "พฤศจิกายน";
	$marr['12'] = "ธันวาคม";	
	
	$darr[] = "อาทิตย์";
	$darr[] = "จันทร์";
	$darr[] = "อังคาร";
	$darr[] = "พุธ";
	$darr[] = "พฤหัสบดี";
	$darr[] = "ศุกร์";
	$darr[] = "เสาร์";
		
	function next_months( $base_time = null, $months = 1 )
	{

		if (is_null($base_time))
			$base_time = time();
		
		$x_months_to_the_future    = strtotime( "+" . $months . " months", $base_time );
		
		$month_before              = (int) date( "m", $base_time ) + 12 * (int) date( "Y", $base_time );
		$month_after               = (int) date( "m", $x_months_to_the_future ) + 12 * (int) date( "Y", $x_months_to_the_future );
		
		if ($month_after > $months + $month_before)
			$x_months_to_the_future = strtotime( date("Ym01His", $x_months_to_the_future) . " -1 day" );
		
		return $x_months_to_the_future;
	}


?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' valign='bottom' style='padding-left:30px; font-size:40px;'>
      <select name="fromdate" id="fromdate" style="width:200px; font-size:30px;"   onchange="changeURL()">
				<?
					for($ii=-12;$ii<=12;$ii++){
						$time = next_months( strtotime(date('Y',time()).'-'.date('m',time()).'-1') ,$ii);
						echo "<option value='";
						echo date('m-Y',$time);
						if($_GET[fromdate] != ""){
							if(date('m-Y',$time) == $_GET[fromdate]){
								$selected = 'selected';
								$my = date('Y-m',$time);
							}else{
								$selected = '';
							}
						}else{
							if(date('m-Y',$time) == date('m-Y',time())){
								$selected = 'selected';
								$my = date('Y-m',$time);
							}else{
								$selected = '';
							}
						}
						echo "'$selected>";
						$m = date('m',$time);
						echo $marr[$m].' '.(date('Y',$time) + 543 );
						echo "</option>";
					
					}
				?>             
	    </select>
		<select name="company_id" id="company_id" style="width:150px; font-size:30px;"   onchange="changeURL()">
		<option value="">ทุกบริษัท</option>
          <?php 
				$sql = "select * from `company` where company_active = 'yes'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($_REQUEST[company_id] == $row[company_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[company_id]."' $selected >".$row[company_name]."</option>";
				} 
			?>
        </select>
		<select name="branch_id" id="branch_id" style="width:150px; font-size:30px;" onchange="changeURL()" >
		<option value="">ทุกสาขา</option>
          <?php 
				$sql = "select * from `branch` where branch_active = 'yes'  Order By  branch_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($_REQUEST[branch_id] == $row[branch_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[branch_id]."' $selected >".$row['branch_name']."</option>";
				} 
			?>
        </select>
		<select name="department_id" id="department_id"  style="width:220px; font-size:30px;"  onchange="changeURL()">
		<option value="">ทุกแผนก</option>
          <?php 
				$sql = "select * from `department` where department_active = 'yes' Order By  department_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($_REQUEST[department_id] == $row[department_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[department_id]."' $selected >".$row['department_name']."</option>";
				} 
			?>
        </select>

      <select id="leave_type" name="leave_type" style="width:150px; font-size:30px;" onchange="changeURL()">
				 <option value="" <? if($_GET[leave_type] == ""){?> selected="selected" <? }?>>ทุกการลา</option>
                <option value="personal" <? if($_GET[leave_type] == "personal"){?> selected="selected" <? }?>>ลากิจ</option>
                <option value="sick" <? if($_GET[leave_type] == "sick"){?> selected="selected" <? }?>>ลาป่วย</option>
                <option value="annual" <? if($_GET[leave_type] == "annual"){?> selected="selected" <? }?>>ลาพักร้อน</option>
                <option value="other" <? if($_GET[leave_type] == "other"){?> selected="selected" <? }?>>ลาอื่นๆ</option>
      </select></td>
  </tr>
  <?  
$all_apporve_name[0] = "-";
		$sql = "SELECT * FROM  `user` ";
		$result = mysql_query($sql); 
		while($row = mysql_fetch_array($result)){
					$all_user_name[$row[user_id]] = $row['title'].$row['name']." ".$row[sname];
					$all_apporve_name[$row[user_id]] = $row[name]." ".$row[sname];

		}
		
$sql = "select * from `user` where user_id != '' "; 
if($_REQUEST[company_id] != ""){ $sql .= " AND company_id = '$_REQUEST[company_id]' " ;}
if($_REQUEST[branch_id] != ""){ $sql .= " AND branch_id = '$_REQUEST[branch_id]' " ;}
if($_REQUEST[department_id] != ""){ 
	$sql_pos = "select * from position where department_id = '$_REQUEST[department_id]'";
	$res_pos = mysql_query($sql_pos);
	while($row_pos =  mysql_fetch_array($res_pos)){
		$all_position_id .= $row_pos[position_id].",";
	}
	$all_position_id = substr($all_position_id,0,strlen($all_position_id)-1);
	$sql .= " AND position_id IN ($all_position_id) " ;
}
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_user_id .= $row[user_id].",";
}
$all_user_id = substr($all_user_id,0,strlen($all_user_id)-1);

$sql = "select * FROM  `dayleave_detail` where `leave_type` like  '%$_GET[leave_type]%' AND `dayleave_date` like '%$my%' AND user_id in ($all_user_id)  Group By `dayleave_id`";
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
            <th>ผู้ขอลา</th>
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
while($arr = mysql_fetch_array($result)){
if($tmp != $arr['user_id'] && $i > 1 ){
?>
          <tr>
            <td colspan="6" align="right"><em>สรุปวันลาที่อนุมัติ <? echo $all_apporve_name[$tmp]; ?></em></td>
            <td align="right" ><? 
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43); 
			/*if($arr[date_apporve] != ""){
				$ex = explode(',' , $arr[date_request]); 
				if($arr[dayleave_hour] != ""){ 
					if($arr[dayleave_hour] < 8){
						echo $arr[dayleave_hour]." ชม."; 
					}else{
						echo count($ex)." วัน";
					}
				}else { 
					echo count($ex)." วัน";
				} 
			}else{
				echo "-";
			}*/
			//echo $sum_leave;
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
		  <tr><td colspan="9" style="border-bottom:none;">&nbsp;</td></tr>
<? 
$sum_leave = 0;

} ?>
          <tr>
            <td><? echo $i; ?></td>
            <td align="left"><? echo $all_apporve_name[$arr['user_id']]; ?></td>
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
					}else{
						echo count($ex)." วัน";
						$c_min = (count($ex) * 8 * 60);
						$sum_leave += $c_min;
					}
				}else { 
					echo count($ex)." วัน";
					$c_min = (count($ex) * 8 * 60);
					$sum_leave += $c_min;
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
 if( $tmp != "" ){
?>
          <tr>
            <td colspan="6" align="right"><em>สรุปวันลาที่อนุมัติ <? echo $all_apporve_name[$tmp]; ?></em></td>
            <td align="right" ><? 
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43); 
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
<? } ?>

        </tbody>
      </table>
      <br />
		<img src="prohibit.png" height=15  /> รอพิจารณา
	  	<img src="trafficlight red.png" height=15  />  ไม่อนุมัติ 
		<img src="trafficlight green.png" height=15  />  อนุมัติ
	  
	  <br /></td>
  </tr>
</table>
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
