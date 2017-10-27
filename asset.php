<? include("header.php"); ?>
<script>
	function RelaodPage(){
		window.location.href = "asset.php?asset_branch_id="+document.getElementById("asset_branch_id").value+"&owner_user_id="+document.getElementById("owner_user_id").value+"&category_id="+document.getElementById("category_id").value+"&asset_type="+document.getElementById("asset_type").value;
	}
		function check_uncheck_all(checkname, field)
	{
		var lng = document.getElementById('leng').value;
		
		for (i = 1; i < lng; i++) {
			if(!document.getElementById('refid'+i).disabled){
			document.getElementById('refid'+i).checked  = field.checked? true:false
			}
			
		}
	}
	function printinvoice(){
		var checkname = document.getElementById('leng').value;
		var id = '';
		for (i = 1; i < checkname; i++) {
			if(document.getElementById('refid'+i).checked ){
				id += document.getElementById('refid'+i).value+'_';
			}
		}
		document.getElementById('all_barocde').value = id;
		document.form1.submit();
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
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><select name="asset_branch_id" id="asset_branch_id" style="width:250px; font-size:30px;" onchange="RelaodPage()" >
		<option value="">ทุกสาขา</option>
          <?php 
				$sql = "select * from `asset_branch`  ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($_REQUEST[asset_branch_id] == $row[asset_branch_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[asset_branch_id]."' $selected >".$row['asset_branch_name']."</option>";
				} 
			?>
        </select>
		<select  style="width:250px; font-size:30px;" name="owner_user_id" id="owner_user_id" onchange="RelaodPage()">
				<option value="">พนักงานทุกคน</option>

	  <? 
		$sql = "SELECT * FROM  `user` ";
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
	  ?>
	  </select>
	  <select name="category_id" id="category_id" style="width:250px; font-size:30px;" onchange="RelaodPage()">
	  				<option value="">ทุกหมวดหมู่</option>

          <?php 
				$sql = "select * from `asset_category`";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					if($_REQUEST[category_id] == $row[asset_category_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}
					echo "<option value='".$row[asset_category_id]."' $selected >".$row[asset_category_name]."</option>";
				} 
			?>
        </select>
		<select name="asset_type" id="asset_type" style="width:250px; font-size:30px;" onchange="RelaodPage()">
	  	<option value="">ทุุกประเภท</option>
          <option value=company <? if($_REQUEST[asset_type] == 'company'){?> selected="selected" <? } ?>>ทรัพย์สินส่วนกลาง</option>
          <option value=personal <? if($_REQUEST[asset_type] == 'personal'){?> selected="selected" <? } ?>>ทรัพย์สินส่วนบุคคล</option>
        </select>
		</td>
    <td align='right' style='padding-right:30px;'><a class='orange large button' onclick="printinvoice();" href="#" style='text-align:center; height:30px; font-size:30px; width:200px;'><strong>พิมพ์บาร์โคด</strong></a></td>
  </tr>
  <?  
$sql_query = "select * from `asset` Where asset_id != ''"; 
if($_REQUEST[asset_branch_id] != ""){
	$sql_query .= " And asset_branch_id = '$_REQUEST[asset_branch_id]' "; 
}
if($_REQUEST[owner_user_id] != ""){
	$sql_query .= " And owner_user_id = '$_REQUEST[owner_user_id]' "; 
}
if($_REQUEST[category_id] != ""){
	$sql_query .= " And category_id = '$_REQUEST[category_id]' "; 
}
if($_REQUEST[asset_type] != ""){
	$sql_query .= " And asset_type = '$_REQUEST[asset_type]' "; 
}
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' style="font-size:14px;" >
        <thead>
          <tr>
            <th><input name="chk_all" type="checkbox" id="chk_all" onClick="check_uncheck_all(document.form1.refid,this)" /></th>
            <th>Barcode</th>
            <th>ทรัพย์สิน</th>
            <th>Serial Number </th>
            <th align="center">ผู้รับผิดชอบ</th>
            <th align="center">สถานะ</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?
$i = 1;
while($arr = mysql_fetch_array($result)){
?>
          <tr>
            <td><input name="refid<? echo $i?>" type="checkbox" id="refid<? echo $i?>" value="<?php echo $arr[barcode]; ?>"  size="2"/></td>
            <td><? echo $arr['barcode']; ?></td>
            <td><? echo $arr['asset_name']; ?></td>
            <td><? echo $arr['asset_serial']; ?></td>
            <td align="center"><? if($arr['owner_user_id'] == 0){ echo '-'; }else{ echo $all_user_name[$arr['owner_user_id']]; } ?></td>
            <td align="center"><? if($arr['status'] == 'break'){ echo '<font color=red>ไม่พร้อมใช้งาน</font>'; }else{ echo '<font color=green>พร้อมใช้งาน</font>'; } ?></td>
            <td><div align=center><a href=asset_edit.php?asset_id=<? echo $arr[0] ?>><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>
            <td><div align=center><a href=asset_tranfer.php?asset_id=<? echo $arr[0] ?>><img  src="man-24-512.png" width='20'   /></a></div></td>
            <td><div align=center><a href=asset_history.php?asset_id=<? echo $arr[0] ?> target="_blank"><img src="page.png" width='20'   /></a></div></td>
          </tr>
          <? $i++; 
 } ?>
   <input type="hidden" name="leng" id="leng" value="<? echo $i?>"  />
        </tbody>
      </table>
      <br />
    </td>
  </tr>
</table>
</form>
<? include("footer.php"); ?>
