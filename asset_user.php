<? include("header.php"); ?>
<script>
	function RelaodPage(){
		window.location.href = "asset_user.php?owner_user_id="+document.getElementById("owner_user_id").value;
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
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><select  style="width:250px; font-size:30px;" name="owner_user_id" id="owner_user_id" onchange="RelaodPage()">
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
	  </select></td>
    <td align='right' style='padding-right:30px;'><h3>สรุปทรัพย์สิน จำแนกตามบุคคล</h1></td>
  </tr>
  <?  
$sql_query = "select * from `asset` Where asset_id != ''"; 
if($_REQUEST[owner_user_id] != ""){
	$sql_query .= " And owner_user_id = '$_REQUEST[owner_user_id]' "; 
}
$sql_query .= "Order By owner_user_id ";
$result = mysql_query($sql_query); 
?>
  <tr>
    <td align='center' colspan='2'><table id='hor-minimalist-b' style="font-size:14px;" >
        <thead>
          <tr>
            <th>&nbsp;</th>
            <th>Barcode</th>
            <th>ทรัพย์สิน</th>
            <th>Serial Number </th>
            <th align="center">สถานะ</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?

while($arr = mysql_fetch_array($result)){
	if($tmp != $arr['owner_user_id']){
	$i = 1;
?>
          <tr>
            <td colspan="6"><? if($arr['owner_user_id'] == 0){ echo 'ไม่มีผู้รับผิดชอบ'; }else{ echo $all_user_name[$arr['owner_user_id']]; } ?></td>
<? } ?>
          <tr>
            <td><? echo $i; ?></td>
            <td><? echo $arr['barcode']; ?></td>
            <td><? echo $arr['asset_name']; ?></td>
            <td><? echo $arr['asset_serial']; ?></td>
            <td align="center"><? if($arr['status'] == 'break'){ echo '<font color=red>ไม่พร้อมใช้งาน</font>'; }else{ echo '<font color=green>พร้อมใช้งาน</font>'; } ?></td>
            <td><div align=center><a href=asset_history.php?asset_id=<? echo $arr[0] ?> target="_blank"><img src="page.png" width='20'   /></a></div></td>
          </tr>
          <? $i++; 
		  $tmp = $arr['owner_user_id'];
 } ?>

        </tbody>
      </table>
      <br />
    </td>
  </tr>
</table>
</form>
<? include("footer.php"); ?>
