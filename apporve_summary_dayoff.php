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
}    </style>
<form name="form1" action="print_barcode.php" method="post" onsubmit="return doSubmit(this);" target="_blank">
<input type="hidden" name="all_barocde" id="all_barocde" value=""  />
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td colspan="2" align='left' valign='bottom' style='padding-left:30px; font-size:40px;'>
      อนุมัติการเปลี่ยนวันหยุด</td>
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

$app_u_id = "[".$_SESSION[ss_user_id]."]";
$sql_query = "select * from `dayoff_change` where approve_user_id like '%$app_u_id%' Order By user_id"; 
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
            <th width="50">ที่.</th>
            <th align="center">พนักงาน</th>
            <th align="center">วันหยุดเดิม</th>
            <th align="center">วันหยุดใหม่</th>
			<th align="center">หมายเหตุ</th>
			<th align="center">สถานะ</th>
            <th align="center">ผู้อนุมัติ</th>
            <th align="center">&nbsp;</th>
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
		  <tr><td colspan="9" style="border-bottom:none;">&nbsp;</td>
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
            <td align="center"><? if($arr['dayoff_change_status'] == 'no'){ ?><a href="apporve_dayoff.php?action=approve&user_id=<? echo $arr[user_id]; ?>&old_dayoff=<? echo $arr[old_dayoff]; ?>&new_dayoff=<? echo $arr[new_dayoff]; ?>&dayoff_change_id=<? echo $arr[dayoff_change_id]; ?>"><img src="correct.png"  width="24" /></a><? } ?></td>
            <td align="center"><? if($arr['dayoff_change_status'] == 'no'){ ?><a href="apporve_dayoff.php?action=reject&user_id=<? echo $arr[user_id]; ?>&old_dayoff=<? echo $arr[old_dayoff]; ?>&new_dayoff=<? echo $arr[new_dayoff]; ?>&dayoff_change_id=<? echo $arr[dayoff_change_id]; ?>"><img src="incorrect.png" width="24"  /></a><? } ?></td>
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
