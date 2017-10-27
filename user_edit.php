<? include("header.php");
$marr[] = "มกราคม";
$marr[] = "กุมภาพันธ์";
$marr[] = "มีนาคม";
$marr[] = "เมษายน";
$marr[] = "พฤษภาคม";
$marr[] = "มิถุนายน";
$marr[] = "กรกฎาคม";
$marr[] = "สิงหาคม";
$marr[] = "กันยายน";
$marr[] = "ตุลาคม";
$marr[] = "พฤศจิกายน";
$marr[] = "ธันวาคม";	

$darr[] = "อาทิตย์";
$darr[] = "จันทร์";
$darr[] = "อังคาร";
$darr[] = "พุธ";
$darr[] = "พฤหัสบดี";
$darr[] = "ศุกร์";
$darr[] = "เสาร์";

 ?>
<script>

function doSubmit(){
	var bod = document.getElementById("bodyyyy").value+"-"+document.getElementById("bodmm").value+"-"+document.getElementById("boddd").value;
	var str = document.getElementById("stryyyy").value+"-"+document.getElementById("strmm").value+"-"+document.getElementById("strdd").value;
	var pass = document.getElementById("passyyyy").value+"-"+document.getElementById("passmm").value+"-"+document.getElementById("passdd").value;
	var retire = document.getElementById("retireyyyy").value+"-"+document.getElementById("retiremm").value+"-"+document.getElementById("retiredd").value;

	document.getElementById("dob").value = bod;
	document.getElementById("date_start").value = str;
	document.getElementById("date_apporve").value = pass;
	document.getElementById("date_retire").value = retire;

	document.getElementById("form1").submit();
}</script>
<?
$sql = "select * from position";
$res = mysql_query($sql);
while($row =  mysql_fetch_array($res)){
	$all_department_id[$row[position_id]] = $row[department_id];
}

$sql_query = " select * from user where user_id = $_REQUEST[user_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
?>

<form action=user_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขพนักงาน</strong></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">รหัสพนักงาน</td>
      <td  align=left><? echo $detail[user_code]; ?></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">Username</td>
      <td  align=left><input type="text" name="username" id="username" style="width:450px; font-size:30px;"  value="<? echo $detail[username]; ?>"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">E-mail</td>
      <td  align=left><input type="text" name="email" id="email" style="width:450px; font-size:30px;"  value="<? echo $detail[email]; ?>"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">คำนำหน้า</td>
      <td  align=left><input type="text" name="title" id="title" style="width:450px; font-size:30px;" value="<? echo $detail[title]; ?>"   /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">ชื่อ</td>
      <td  align=left><input type="text" name="name" id="name" style="width:450px; font-size:30px;"  value="<? echo $detail[name]; ?>"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สกุล</td>
      <td  align=left><input type="text" name="sname" id="sname" style="width:450px; font-size:30px;" value="<? echo $detail[sname]; ?>"   /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วัน เดือน ปี เกิด </td>
      <td  align=left><select name="boddd" id="boddd" style="width:100px; font-size:30px;">
          <?
		  		$ex = explode("-",$detail[dob]);
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == $ex[2]){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="bodmm" id="bodmm" style="width:180px; font-size:30px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					if($stri == $ex[1]){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="bodyyyy" id="bodyyyy" style="width:150px; font-size:30px;">
          <?
				$y = date("Y");
				$yth = $y+543;
				for($i=-80;$i<1;$i++){ 
			?>
          <option value="<?=$y+$i?>" <? if( ($y+$i) == $ex[0]){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
          <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">บริษัท</td>
      <td  align=left><select name="company_id" id="company_id" style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `company` where company_active = 'yes'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($detail[company_id] == $row[company_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[company_id]."' $selected >".$row[company_name]."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สาขา</td>
      <td  align=left><select name="branch_id" id="branch_id" style="width:450px; font-size:30px;" >
          <?php 
				$sql = "select * from `branch` where branch_active = 'yes'  Order By   branch_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($detail[branch_id] == $row[branch_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[branch_id]."' $selected >".$row['branch_name']."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td  align=right style="padding-right:20px;">แผนก</td>
      <td  align=left><select name="department_id" id="department_id"  style="width:450px; font-size:30px;"  onchange="changePosition()">
          <?php 
				$sql = "select * from `department` where department_active = 'yes' Order By  department_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($all_department_id[$detail[position_id]] == $row[department_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[department_id]."' $selected >".$row['department_name']."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">ตำแหน่ง</td>
      <td  align=left><div id="div_position">
          <select name="position_id"  style="width:450px; font-size:30px;">
          </select>
        </div></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สิทธิการใช้งาน</td>
      <td  align=left><select name="user_level" style="width:450px; font-size:30px;" >
          <option value=admin 	<? if($detail[user_level] == "admin"){ ?> selected="selected" <? } ?>>ผู้ดูแลระบบ</option>
          <option value=manager <? if($detail[user_level] == "manager"){ ?> selected="selected" <? } ?>>ผู้จัดการ</option>
          <option value=user 	<? if($detail[user_level] == "user"){ ?> selected="selected" <? } ?>>พนักงาน</option>
		  <option value=admin_branch 	<? if($detail[user_level] == "admin_branch"){ ?> selected="selected" <? } ?>>แอดมิน สาขา</option>
        </select></td>
    </tr>
  <!--  <tr>
      <td width='35%'  align=right style="padding-right:20px;">ชุดวันหยุด</td>
      <td  align=left><select name="dayoff_id" id="dayoff_id"  style="width:450px; font-size:30px;"  onchange="changePosition()">
          <?php 
				$sql = "select * from `dayoff` ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($detail[dayoff_id] == $row[dayoff_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[dayoff_id]."' $selected >".$row['dayoff_name']."</option>";
				} 
			?>
        </select></td>
    </tr> -->
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">รูปภาพ</td>
      <td  align=left><input type="file" name="picture" id="picture" style="font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สถานะพนักงาน</td>
      <td  align=left><select name="user_status" id="user_status" style="width:450px; font-size:30px;"  onchange="changeUserStatus()">
          <option value=test 	<? if($detail[user_status] == "test"){ ?> selected="selected" <? } ?>>ทดลองงาน</option>
          <option value=approve <? if($detail[user_status] == "approve"){ ?> selected="selected" <? } ?>>ผ่านงาน</option>
          <option value=retire 	<? if($detail[user_status] == "retire"){ ?> selected="selected" <? } ?>>ลาออก</option>
        </select></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;" valign="top">ผู้อนุมัติวันลา</td>
      <td  align=left valign="top"><select multiple style="width:450px; font-size:30px;" name="apporver[]" id="apporver">
          <? 
	  	$sql = "SELECT * FROM  `position` where position_level_id > 1";
	  	$res = mysql_query($sql);
		while($row = mysql_fetch_array($res)){
			$all_pos_id .= $row[position_id].',';
			$position_name[$row[position_id]] =  $row[position_name];
		}
		$all_pos_id = substr($all_pos_id,0,strlen($all_pos_id)-1);
		
		$sql = "SELECT * FROM  `user` Where position_id in ($all_pos_id) And user_status != 'retire' ";
		$result = mysql_query($sql); 
		
		$ex = explode(",",$detail[leave_apporve_id]);
		while($row = mysql_fetch_array($result)){
			//for($i=0;$i<5;$i++){
			// echo "<input type='checkbox' name='apporver[]' value='".$row['user_id']."' /> ".$row['title'].$row['name']." ".$row[sname]."<br>";
			// }
					if(in_array("[".$row[user_id]."]",$ex)){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}

					echo "<option value='[".$row[user_id]."]' $selected >".$row['title'].$row['name']." ".$row[sname]." ( ".$position_name[$row[position_id]]." ) </option>";
		}
	  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วันเริ่มงาน</td>
      <td  align=left><select name="strdd" id="strdd" style="width:100px; font-size:30px;">
          <?
		  		$ex = explode("-",$detail[date_start]);
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == $ex[2]){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="strmm" id="strmm" style="width:180px; font-size:30px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					if($stri == $ex[1]){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="stryyyy" id="stryyyy" style="width:150px; font-size:30px;">
          <?
				$y = date("Y");
				$yth = $y+543;
				for($i=-20;$i<2;$i++){ 
				
			?>
          <option value="<?=$y+$i?>" <? if( ($y+$i) == $ex[0]){?> selected="selected" <? } ?>>

          <?=$yth+$i?>
          </option>
          <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วันผ่านงาน</td>
      <td  align=left><select name="passdd" id="passdd" style="width:100px; font-size:30px;">
          <?	
		  		$ex = explode("-",$detail[date_apporve]);
	
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == $ex[2]){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="passmm" id="passmm" style="width:180px; font-size:30px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					if($stri == $ex[1]){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="passyyyy" id="passyyyy" style="width:150px; font-size:30px;">
          <?
				$y = date("Y");
				$yth = $y+543;
				for($i=-20;$i<2;$i++){ 
			?>
          <option value="<?=$y+$i?>" <? if( ($y+$i) == $ex[0]){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
          <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วันลาออก</td>
      <td  align=left><select name="retiredd" id="retiredd" style="width:100px; font-size:30px;" disabled="disabled">
          <?
		  		$ex = explode("-",$detail[date_retire]);
				if($detail[date_retire] == "0000-00-00"){
					$ex = explode("-",date("Y-m-d"));
				}
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == $ex[2]){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="retiremm" id="retiremm" style="width:180px; font-size:30px;" disabled="disabled">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					if($stri == $ex[1]){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="retireyyyy" id="retireyyyy" style="width:150px; font-size:30px;" disabled="disabled">
          <?
				$y = date("Y");
				$yth = $y+543;
				for($i=-20;$i<2;$i++){ 
			?>
          <option value="<?=$y+1?>" <? if( ($y+1) == $ex[0]){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
          <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขข้อมูลพนักงาน</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="dob" id="dob" />
  <input type="hidden" name="date_start" id="date_start" />
  <input type="hidden" name="date_apporve" id="date_apporve" />
  <input type="hidden" name="date_retire" id="date_retire" />
  <input type="hidden" name="user_id" value="<? echo $detail[user_id]; ?>"   >
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
function changeUserStatus(){
		var user_status = document.getElementById("user_status").value;
		if(user_status != "retire"){
			document.getElementById("retiredd").disabled = true;
			document.getElementById("retiremm").disabled = true;
			document.getElementById("retireyyyy").disabled = true;
		}else{
			document.getElementById("retiredd").disabled = false;
			document.getElementById("retiremm").disabled = false;
			document.getElementById("retireyyyy").disabled = false;
		}
}
function changePosition(){
		var department_id = document.getElementById("department_id").value;
		
			var url = "";
			url +=  "department_id="+department_id;
			url += "&";
			url +=  "position_id=<? echo $detail[position_id]; ?>";
	
			var ajax1=createAjax(); 
			ajax1.onreadystatechange=function(){
				//alert(ajax1.responseText);
				if(ajax1.readyState==4 && ajax1.status==200){
					document.getElementById("div_position").innerHTML = ajax1.responseText;
				}
			}
			ajax1.open("POST","ajax_search_position.php",true);
			ajax1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
			ajax1.send(url);

}
window.onload=changePosition();
</script>
<? include("footer.php"); ?>
