<?php include("header.php"); ?>
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
}    </style>
<form name="form1" action="print_barcode.php" method="post" onsubmit="return doSubmit(this);" target="_blank">
<input type="hidden" name="all_barocde" id="all_barocde" value=""  />
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td colspan="2" align='left' valign='bottom' style='padding-left:30px; font-size:40px;'>
      สรุปวันลาประจำปี
	  <select  style="width:250px; font-size:30px;" name="year" id="year" onchange="RelaodPage()">
		  <option value="2014" <?php if($_REQUEST['year'] == 2014){?> selected="selected" <?php } ?>>2557</option>
		  <option value="2015" <?php if($_REQUEST['year'] == 2015){?> selected="selected" <?php } ?>>2558</option>
		   <option value="2016" <?php if($_REQUEST['year'] == 2016){?> selected="selected" <?php } ?>>2559</option>
		   <option value="2017" <?php if($_REQUEST['year'] == 2017){?> selected="selected" <?php } ?>>2560</option>
	  </select></td>
    </tr>
  <?php
if($_SESSION['ss_user_id'] != ""){
$all_apporve_name[0] = "-";

$sql = "select * from `user` where user_id != '' ";
if($_SESSION['ss_user_id'] != ""){ $sql .= "  " ;}
$res = mysqli_query($_SESSION['connect'],$sql);
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$all_user_id .= $row['user_id'].",";
	$all_apporve_name[$row['user_id']] = $row['name']." ".$row['sname'];
}
$all_user_id = substr($all_user_id,0,strlen($all_user_id)-1);

$sql = "select * FROM  `dayleave_detail` where `leave_type` like  '%$_GET[leave_type]%' AND `dayleave_date` like '%$_REQUEST[year]%' AND user_id in ($_SESSION[ss_user_id])  Group By `dayleave_id`";
$res = mysqli_query($_SESSION['connect'],$sql);
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$all_dayleave_id .= $row['dayleave_id'].",";
}
$all_dayleave_id = substr($all_dayleave_id,0,strlen($all_dayleave_id)-1);

$sql_query = "select * from `dayleave` where dayleave_id in ($all_dayleave_id) Order By user_id";
$result = mysqli_query($_SESSION['connect'],$sql_query);
$num = mysqli_num_rows($result);

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
          <?php
$i = 1;
$sum_leave = 0;
while($arr = mysqil_fetch_array($result,MYSQLI_BOTH)){
if($tmp != $arr['user_id'] && $i > 1 ){
?>
          <tr>
            <td colspan="5" align="right"><em>สรุปวันลาที่อนุมัติ <?php echo $all_apporve_name[$tmp]; ?></em></td>
            <td align="right" ><?php
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
            <td align="center"><div align=center><a onclick="show_detail(<?php echo $arr[0] ?>);"></a></div></td>
		  </tr>
		  <tr><td colspan="8" style="border-bottom:none;">&nbsp;</td></tr>
<?php
$sum_leave = 0;

} ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $all_leave_type[$arr['dayleave_type']]; ?></td>
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
            <td align="center"><?php
				$ex  = explode(",",$arr['date_request']);
				for($a=0;$a<count($ex);$a++){
					echo date("d/m/",strtotime($ex[$a])).(date("y",strtotime($ex[$a]))+43)."<br>";
				}
		 ?></td>
            <td align="center"><?php if($arr['approved_user_id'] == 0){ echo "-"; }else{
				if($arr[date_apporve] != ""){
					$ex  = explode(",",$arr['date_apporve']);
					for($a=0;$a<count($ex);$a++){
						echo date("d/m/",strtotime($ex[$a])).(date("y",strtotime($ex[$a]))+43)."<br>";
					}
				}else{
					echo "-";
				}
				}?></td>
			<td align="right" ><?php
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
            <td align="center"><?php echo $all_apporve_name[$arr['approved_user_id']]; ?></td>
            <td align="center"><div align=center><a onclick="show_detail(<?php echo $arr[0] ?>);"><img src='page.png' width='20' height="20"   /></a></div></td>
		  </tr>
          <?
		  $tmp = $arr['user_id'];
		  $i++;
 }
 if( $tmp != "" ){
?>
          <tr>
            <td colspan="5" align="right"><em>สรุปวันลาที่อนุมัติ <? echo $all_apporve_name[$tmp]; ?></em></td>
            <td align="right" ><?php
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
            <td align="center"><div align=center><a onclick="show_detail(<?php echo $arr[0] ?>);"></a></div></td>
		  </tr>
		  		            <tr>
            <td colspan="5" align="right"><em>สรุปวันลาป่วย</em></td>
            <td align="right" ><?php
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43);
			if(floor(($sum_leave_t['sick'] / 480 )) > 0){
				echo floor(($sum_leave_t['sick'] / 480 ))." วัน ";
			}
			$hours = floor(($sum_leave_t['sick'] % 480 )/ 60);
			$minutes = ($sum_leave_t['sick'] % 480 ) % 60;
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
            <td align="center">&nbsp;</td>
		            </tr>
		            <tr>
                      <td colspan="5" align="right"><em>สรุปวันลากิจ</em></td>
		              <td align="right" ><?php
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43);
			if(floor(($sum_leave_t['personal'] / 480 )) > 0){
				echo floor(($sum_leave_t['personal'] / 480 ))." วัน ";
			}
			$hours = floor(($sum_leave_t['personal'] % 480 )/ 60);
			$minutes = ($sum_leave_t['personal'] % 480 ) % 60;
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
		              <td align="center">&nbsp;</td>
          </tr>
		            <tr>
                      <td colspan="5" align="right"><em>สรุปวันลาพักร้อน</em></td>
		              <td align="right" ><?php
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43);
			if(floor(($sum_leave_t['annual'] / 480 )) > 0){
				echo floor(($sum_leave_t['annual'] / 480 ))." วัน ";
			}
			$hours = floor(($sum_leave_t['annual'] % 480 )/ 60);
			$minutes = ($sum_leave_t['annual'] % 480 ) % 60;
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
		              <td align="center">&nbsp;</td>
          </tr>
		            <tr>
                      <td colspan="5" align="right"><em>สรุปวันลาอื่นๆ</em></td>
		              <td align="right" ><?php
			//echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43);
			if(floor(($sum_leave_t['other'] / 480 )) > 0){
				echo floor(($sum_leave_t['other'] / 480 ))." วัน ";
			}
			$hours = floor(($sum_leave_t['other'] % 480 )/ 60);
			$minutes = ($sum_leave_t['other'] % 480 ) % 60;
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
		              <td align="center">&nbsp;</td>
          </tr>
<?php }

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

<?php include("footer.php"); ?>
