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
	document.getElementById("dob").value = bod;
	document.getElementById("date_start").value = str;
	document.getElementById("date_apporve").value = pass;
	
	document.getElementById("form1").submit();
}</script>

<form action=user_doadd.php method=post id=form1 enctype="multipart/form-data">
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มพนักงาน</strong></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">รหัสพนักงาน</td>
      <td  align=left><input type="text" name="user_code" id="user_code" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">Username</td>
      <td  align=left><input type="text" name="username" id="username" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">Password</td>
      <td  align=left><input type="password" name="password" id="password" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">E-mail</td>
      <td  align=left><input type="text" name="email" id="email" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">คำนำหน้า</td>
      <td  align=left><input type="text" name="title" id="title" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">ชื่อ</td>
      <td  align=left><input type="text" name="name" id="name" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สกุล</td>
      <td  align=left><input type="text" name="sname" id="sname" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วัน เดือน ปี เกิด </td>
      <td  align=left><select name="boddd" id="boddd" style="width:100px; font-size:30px;">
          <?
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == date("d")){
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
					if($stri == date("m")){
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
          <option value="<?=$y+1?>" <? if($i == 0){?> selected="selected" <? } ?>>
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
					echo "<option value='".$row[company_id]."'>".$row[company_name]."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">สาขา</td>
      <td  align=left><select name="branch_id" id="branch_id" style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `branch` where branch_active = 'yes'  Order By  branch_name";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
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
					echo "<option value='".$row[department_id]."'>".$row['department_name']."</option>";
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
      <td  align=left><select name="user_level" style="width:450px; font-size:30px;">
          <option value=admin>ผู้ดูแลระบบ</option>
          <option value=manager>ผู้จัดการ</option>
          <option value=user>พนักงาน</option>
		  <option value=admin_branch>แอดมิน สาขา</option>
        </select></td>
    </tr>
   <!-- <tr>
      <td width='35%'  align=right style="padding-right:20px;">ชุดวันหยุด</td>
      <td  align=left><select name="dayoff_id" id="dayoff_id"  style="width:450px; font-size:30px;"  onchange="changePosition()">
          <?php 
				$sql = "select * from `dayoff` ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo "<option value='".$row[dayoff_id]."'>".$row['dayoff_name']."</option>";
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
      <td  align=left><select name="user_status" style="width:450px; font-size:30px;">
          <option value=test>ทดลองงาน</option>
          <option value=approve>ผ่านงาน</option>
        </select></td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;" valign="top">ผู้อนุมัติวันลา</td>
      <td  align=left valign="top">
	  <select multiple style="width:450px; font-size:30px;" name="apporver[]" id="apporver">
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
		while($row = mysql_fetch_array($result)){
			//for($i=0;$i<5;$i++){
			// echo "<input type='checkbox' name='apporver[]' value='".$row['user_id']."' /> ".$row['title'].$row['name']." ".$row[sname]."<br>";
			// }
					echo "<option value='[".$row[user_id]."]'>".$row['title'].$row['name']." ".$row[sname]." ( ".$position_name[$row[position_id]]." ) </option>";
		}
	  ?>
	  </select>
	  </td>
    </tr>
    <tr>
      <td width='35%'  align=right style="padding-right:20px;">วันเริ่มงาน</td>
      <td  align=left><select name="strdd" id="strdd" style="width:100px; font-size:30px;">
          <?
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == date("d")){
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
					if($stri == date("m")){
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
          <option value="<?=$y+1?>" <? if($i == 0){?> selected="selected" <? } ?>>
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
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == date("d")){
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
					if($stri == date("m")){
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
          <option value="<?=$y+1?>" <? if($i == 0){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
		  <? } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มข้อมูลพนักงาน</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
 <input type="hidden" name="dob" id="dob" />
 <input type="hidden" name="date_start" id="date_start" />
 <input type="hidden" name="date_apporve" id="date_apporve" />
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

function changePosition(){
		var department_id = document.getElementById("department_id").value;
		
		//if(barcode != "" || keyword != "" || category != "all" || brand != "all" ){
			var url = "";
			url +=  "department_id="+department_id;
	
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
