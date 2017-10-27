<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>อนุมัติคำขอลางาน</strong></td>
    <td align='right' style='padding-right:30px;'>&nbsp;</td>
  </tr>
  <?  
$all_apporve_name[0] = "-";

$sql = "select * FROM  `user` ";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_apporve_name[$row[user_id]] = $row[name]." ".$row[sname];
}

$sql = "select * FROM  `dayleave_detail` Where approve_user_id like '%[$_SESSION[ss_user_id]]%' Group By `dayleave_id`";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_dayleave_id .= $row[dayleave_id].",";
}
$all_dayleave_id = substr($all_dayleave_id,0,strlen($all_dayleave_id)-1);

$sql_query = "select * from `dayleave` where dayleave_id in ($all_dayleave_id)"; 
$result = mysql_query($sql_query); 

/*
$all_status["no"] = "<img src='trafficlight red.png' height=15  />";
$all_status["yes"] = "<img src='trafficlight green.png'  height=15  />";
*/
$all_status["no"] = "<img src='prohibit.png' height=15  />";
$all_status["reject"] = "<img src='trafficlight red.png' height=15  />";
$all_status["approve"] = "<img src='trafficlight green.png'  height=15  />";


$all_leave_type["sick"] = "ลาป่วย";
$all_leave_type["personal"] = "ลากิจ";
$all_leave_type["annual"] = "ลาพักร้อน";
$all_leave_type["other"] = "ลาอื่นๆ";
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th>ที่.</th>
            <th>ผู้ขอลา</th>
            <th>ประเภท</th>
            <th align="center">สถานะ</th>
            <th align="center">วันที่ขอลา</th>
            <th align="center">วันที่อนุมัติ</th>
            <th align="center">ผู้อนุมัติ</th>
            <th align="center">วันทำรายการ</th>
            <th align="center">เพิ่มเติม</th>
			<th align="center">อนุมัติ</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td><? echo $i; ?></td>
            <td align="center"><? echo $all_apporve_name[$arr['user_id']]; ?></td>
            <td><? echo $all_leave_type[$arr['dayleave_type']]; ?></td>
            <td align="center"><? echo $all_status[$arr['dayleave_status']]; ?></td>
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
            <td align="center"><? echo $all_apporve_name[$arr['approved_user_id']]; ?></td>
            <td align="center"><? echo date("d/m/",strtotime($arr['datetime_entered'])).(date("y",strtotime($arr['datetime_entered']))+43);  ?></td>
            <td align="center"><div align=center><a onclick="show_detail(<? echo $arr[0] ?>);"><img src='page.png' width='20' height="20"   /></a></div></td>
			<td align="center"><div align=center><? if($arr['dayleave_status'] == "no"){ ?> <a href=apporve_leave.php?dayleave_id=<? echo $arr[0] ?>><img src='checked_checkbox.png' width='20' height="20"   /></a> <? } ?></div></td>
          </tr>
          <? $i++; 
 } ?>
        </tbody>
      </table>
      <br />
		<!--
	  	<img src="trafficlight red.png" height=15  />  รอการพิจารณา 
		<img src="trafficlight green.png" height=15  />  พิจารณาแล้ว-->
		<img src="prohibit.png" height=15  /> รอพิจารณา
	  	<img src="trafficlight red.png" height=15  />  ไม่อนุมัติ 
		<img src="trafficlight green.png" height=15  />  อนุมัติ
	  <br />
</td>
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

</script>
<? include("footer.php"); ?>
