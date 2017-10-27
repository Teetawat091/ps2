<? include("header.php"); 

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
<script>
	function RelaodPage(){
		window.location.href = "report_summary_change_dayoff.php?branch_id="+document.getElementById("branch_id").value+"&owner_user_id="+document.getElementById("owner_user_id").value+"&fromdate="+document.getElementById("fromdate").value;
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
}    </style>
<form name="form1" action="print_barcode.php" method="post" onsubmit="return doSubmit(this);" target="_blank">

<input type="hidden" name="all_barocde" id="all_barocde" value=""  />
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td colspan="2" align='left' valign='bottom' style='padding-left:30px; font-size:40px;'>
	<select name="fromdate" id="fromdate" style="width:200px; font-size:30px;"   onchange="RelaodPage()">
				<?
					for($ii=-12;$ii<=1;$ii++){
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
		<select name="branch_id" id="branch_id" style="width:150px; font-size:30px;" onchange="RelaodPage()" >
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
	<select  style="width:250px; font-size:30px;" name="owner_user_id" id="owner_user_id" onchange="RelaodPage()">
				<option value="">เลือกพนักงาน</option>

	  <? 
		$sql = "SELECT * FROM  `user` where user_status != 'retire' ";
		if($_REQUEST[branch_id] != ""){ $sql .= " AND branch_id = '$_REQUEST[branch_id]' " ;}

		$result = mysql_query($sql); 
		while($row = mysql_fetch_array($result)){
				if($_REQUEST[owner_user_id] == $row[user_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}

					echo "<option value='".$row[user_id]."' $selected >".$row['title'].$row['name']." ".$row[sname]."</option>";
					$all_user_name[$row[user_id]] = $row['title'].$row['name']." ".$row[sname];

		}
		
		$sql = "SELECT * FROM  `user` where user_status != 'retire' ";
		$result = mysql_query($sql); 
		while($row = mysql_fetch_array($result)){
			$all_apporve_name[$row[user_id]] = $row[name]." ".$row[sname];
		}

	  ?>
	  </select>	 รายงานการเปลี่ยนวันหยุด</td>
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
}


$sql = "select * from `user` where  user_id != '' "; 
if($_REQUEST[branch_id] != ""){ $sql .= " AND branch_id = '$_REQUEST[branch_id]' " ;}
if($_REQUEST[owner_user_id] != ""){ $sql .= " AND user_id = '$_REQUEST[owner_user_id]' " ;}

$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	
	$all_user_ids .= $row[user_id].",";
}
$all_user_ids = substr($all_user_ids,0,strlen($all_user_ids)-1);


$sql_query = "select * from `dayoff_change` where user_id in ($all_user_ids) AND `old_dayoff` like '%$my%' "; 
$result = mysql_query($sql_query); 
$num = mysql_num_rows($result);

$all_status["no"] = "<img src='prohibit.png' height=15  />";
$all_status["reject"] = "<img src='trafficlight red.png' height=15  />";
$all_status["approve"] = "<img src='trafficlight green.png'  height=15  />";

?>
  <tr>
    <td align='center'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="20">ที่.</th>
            <th align="center" width="20%">ชื่อ สกุล </th>
            <th align="center" width="15%">วันหยุดเดิม</th>
            <th align="center" width="15%">วันหยุดใหม่</th>
			<th align="center">หมายเหตุ</th>
			<th align="center" width="15">สถานะ</th>
            <th align="center" width="20%">ผู้อนุมัติ</th>
            </tr>
        </thead>
        <tbody>
          <?
$i = 1;
$sum_leave = 0;
while($arr = mysql_fetch_array($result)){
if($tmp != $arr['user_id'] && $i > 1 ){
?>
		  <tr><td colspan="7" style="border-bottom:none;">&nbsp;</td>
		    </tr>
<? 
$sum_leave = 0;

} ?>
          <tr>
            <td><? echo $i; ?></td>
            <td align="center"><? echo $all_apporve_name[$arr['user_id']]; ?></td>
            <td align="center"><? 
					echo date("d / m / ",strtotime($arr[old_dayoff])).(date("Y",strtotime($arr[old_dayoff]))+543)."<br>";
		 ?></td>
            <td align="center"><? 					
					echo date("d / m / ",strtotime($arr[new_dayoff])).(date("Y",strtotime($arr[new_dayoff]))+543)."<br>";
			?></td>
			<td align="center" ><? echo $arr['dayoff_change_remark']; ?></td>
			<td align="center" ><? 
				echo $all_status[$arr['dayoff_change_status']];
			 ?></td>
            <td align="center"><? echo $all_apporve_name[$arr['approved_user_id']]; ?></td>
            </tr>
          <? 
		  $tmp = $arr['user_id'];
		  $i++; 
 }
 if( $tmp != "" ){
?>
<? }

}

 ?>
        </tbody>
      </table>
      <br />
		<img src="prohibit.png" height=15  /> รอพิจารณา
	  	<img src="trafficlight red.png" height=15  />  ไม่อนุมัติ 
		<img src="trafficlight green.png" height=15  />  อนุมัติ
	  
	  <br /></td>
  </tr>
</table>
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
