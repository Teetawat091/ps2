<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<? 
if($_FILES['file_asset']['name']){
	$ext = explode('.',$_FILES['file_asset']['name']);
	$extension = $ext[1];
	$newname = rand(1000,9999)."_".time();
	$full_local_path = 'upload/'.$newname.".".$extension ;
	$sql_path = 'upload/'.$newname.".".$extension ;
	move_uploaded_file($_FILES['file_asset']['tmp_name'], $full_local_path);
}else{
	$full_local_path = "";
}


$sql = "Update `asset`  SET `owner_user_id` = '$_REQUEST[owner_user_id]'  , time_start  = '$_REQUEST[asset_tranfer_date]' , `file_asset` = '$full_local_path' Where `asset_id` = $_REQUEST[asset_id] ";
mysql_query($sql);

$sql = "select * from  `asset_log`   Where `asset_id` = $_REQUEST[asset_id] ORDER BY  `asset_log_id` DESC LIMIT 0 , 1";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$old_user_id = $row[new_owner_user_id];

$sql_query = "INSERT INTO `asset_log` (`asset_log_id`, `asset_id`, `old_owner_user_id`, `new_owner_user_id`, `time_start`, `file_asset`, `datetime_entered`) VALUES (NULL, '$_REQUEST[asset_id]', '$old_user_id', '$_REQUEST[owner_user_id]', '$_REQUEST[asset_tranfer_date]', '$full_local_path', NOW());";
mysql_query($sql_query);

 ?>
<meta http-equiv="refresh" content="3; url=asset.php"  />
<? include("footer.php"); ?>
