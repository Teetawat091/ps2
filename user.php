<? include("header.php"); ?>
<script>
	function RelaodPage(){
		window.location.href = "user.php?company_id="+document.getElementById("company_id").value+"&branch_id="+document.getElementById("branch_id").value+"&department_id="+document.getElementById("department_id").value+"&status_id="+document.getElementById("status_id").value;
	}
</script>
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'>
	<select name="company_id" id="company_id" style="width:150px; font-size:30px;"   onchange="RelaodPage()">
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
		<select name="branch_id" id="branch_id" style="width:130px; font-size:30px;" onchange="RelaodPage()" >
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
		<select name="department_id" id="department_id"  style="width:220px; font-size:30px;"  onchange="RelaodPage()">
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
        </select> <select name="status_id" id="status_id"  style="width:150px; font-size:30px;"  onchange="RelaodPage()">
          <option value="">ทุกสถานะ</option>
          <option value="test" <? if($_REQUEST[status_id] == 'test'){?> selected="selected" <? } ?> >ทดลองงาน</option>
          <option value="approve" <? if($_REQUEST[status_id] == 'approve'){?> selected="selected" <? } ?>>ผ่านงาน</option>
          <option value="test_approve" <? if($_REQUEST[status_id] == 'test_approve'){?> selected="selected" <? } ?>>ทดลองงาน & ผ่านงาน</option>
          <option value="retire" <? if($_REQUEST[status_id] == 'retire'){?> selected="selected" <? } ?>>ลาออก</option>
        </select>
	</td>
    <td align='right' style='padding-right:30px;'><a class='orange large button' href=user_add.php style='text-align:center; width:150px; height:30px; font-size:30px;'><strong>เพิ่มพนักงาน</strong></a></td>
  </tr>
  <?  
$all_user_status["test"] = "ทดลองงาน";
$all_user_status["approve"] = "ผ่านงาน";
$all_user_status["retire"] = "ลาออก";
$sql = "select * from position";
$res = mysql_query($sql);
while($row = mysql_fetch_array($res)){
	$all_position[$row[position_id]] = $row[position_name];
}

$sql_query = "select * from `user` where user_id != '' "; 
if($_REQUEST[company_id] != ""){ $sql_query .= " AND company_id = '$_REQUEST[company_id]' " ;}
if($_REQUEST[branch_id] != ""){ $sql_query .= " AND branch_id = '$_REQUEST[branch_id]' " ;}
if($_REQUEST[department_id] != ""){ 
	$sql = "select * from position where department_id = '$_REQUEST[department_id]'";
	$res = mysql_query($sql);
	while($row =  mysql_fetch_array($res)){
		$all_position_id .= $row[position_id].",";
	}
	$all_position_id = substr($all_position_id,0,strlen($all_position_id)-1);
	$sql_query .= " AND position_id IN ($all_position_id) " ;

}
if($_REQUEST[status_id] != ""){
	if($_REQUEST[status_id] == "test_approve"){
		$sql_query .= " AND user_status != 'retire' " ;
	}else{
		$sql_query .= " AND user_status = '$_REQUEST[status_id]' " ;
	}
}
$sql_query .= " Order By user_code ASC " ;
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' >
        <thead>
          <tr>
            <th width="20">ที่.</th>
            <th>รหัส</th>
            <th>ชื่อ-สกุล</th>
            <th>ตำแหน่ง</th>
            <th>สถานะ</th>
            <th>วันเริ่มงาน</th>
            <th  width="20">&nbsp;</th>
            <th  width="20">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td><? echo $i; ?></td>
            <td><? echo $arr['user_code']; ?></td>
            <td><? echo $arr['title'].$arr['name']." ".$arr[sname]; ?></td>
            <td><? echo $all_position[$arr['position_id']]; ?></td>
            <td><? echo $all_user_status[$arr['user_status']]; ?></td>
            <td><? echo date("d/m/",strtotime($arr['date_start'])).(date("y",strtotime($arr['date_start']))+43); ?></td>
            <td><a href=dayoff_detail.php?dayoff_id=<? echo $arr['dayoff_id'] ?>&dayoff_name=<? echo urlencode($arr['name']." ".$arr[sname]); ?>><img src="calen.png" width="20"  /></a></td>
            <td><div align=center><a href=user_edit.php?user_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
          </tr>
          <? $i++; 

 } ?>
        </tbody>
      </table>
      <br />
    </td>
  </tr>
</table>
<? include("footer.php"); ?>
