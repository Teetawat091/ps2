<?php include('header.php'); ?>

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
<form name="form1" target="_blank">

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td colspan="2" align='left' valign='bottom' style='padding-left:30px; font-size:40px;'>
      สรุปการขอออกนอกสถานที่</td>
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
$sql_query = "select * from `user_outgoing` where user_id = $_SESSION[ss_user_id]  "; //where user_id = $_SESSION[ss_user_id] 
$result = mysql_query($sql_query); 
$num = mysql_num_rows($result);

$all_status["wait"] = "<img src='prohibit.png' height=15  />";
$all_status["cancle"] = "<img src='trafficlight red.png' height=15  />";
$all_status["approve"] = "<img src='trafficlight green.png'  height=15  />";

?>
  <tr>
    <td align='center'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="50">ที่.</th>
            <th align="center">ผู้ขอการอนุมัติ</th>
            <th align="center">เวลาที่ขออนุมัติ</th>
			<th align="center">หมายเหตุ</th>
			<th align="center">สถานะ</th>
            </tr>
        </thead>
        <tbody>
          <?

while($arr = mysql_fetch_array($result)){
	if($arr['description']==''){
		$arr['description'] = "-";
	}
if($tmp != $arr['user_id'] && $i > 1 ){
?>
		  <tr><td colspan="6" style="border-bottom:none;">&nbsp;</td>
		    </tr>
<? 
$sum_leave = 0;

} ?>
          <tr>
            <td><? echo $i+1; ?></td>
            <td align="center"><? 
            $namesql = "SELECT title,name,sname FROM user WHERE user_id =".$arr['user_id'];//or user_id = $_SESSION[ss_user_id]
            $resultset = mysql_query($namesql);
            $num = mysql_num_rows($result);
            $res = mysql_fetch_assoc($resultset);
            echo $res['title'].$res['name']."&nbsp;&nbsp;".$res['sname'];
					//echo $arr['user_id']."<br>";
		 ?></td>
            <td align="center"><? 	
            		echo $arr['datetime_enter']."<br>";				
					
			?></td>
			<td align="center" ><? echo $arr['description']."<br>"; ?></td>
			<td align="center" ><? 
				echo $all_status[$arr['status']];
			 ?></td>
            <td align="center"><? echo $all_status[$arr['dayoff_change_status']]; ?></td>
            </tr>
          <? 
		  $tmp = $all_status[$arr['status']];
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