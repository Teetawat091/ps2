<select name="position_id"  style="width:450px; font-size:30px;">
<?
	include("db.php");
	$sql = "select *  FROM  `position` where department_id = '$_REQUEST[department_id]'  Order By `position_level_id` DESC  , `position_name` ASC ";
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	while($row = mysql_fetch_array($res)){ 
		if($row[position_id] == $_REQUEST[position_id]){
			$selected = 'selected="selected"';
		}else{
			$selected = '';
		}
	?>
	<option value="<? echo $row[position_id]; ?>" <? echo $selected; ?> ><? echo $row[position_name]; ?></option>
<?	
	}
	if($num == 0){ 
?>
	<option value="0">ไม่มีตำแหน่งงาน</option>
<? } ?>
</select>
