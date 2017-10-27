<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<? 
 $sql_query = "Insert Into `asset` (`asset_id`,`category_id`,`asset_branch_id`,`asset_name`,`asset_brand`,`asset_model`,`asset_serial`,`asset_order_date`,`asset_order_shop`,`asset_order_no`,`status`,`datetime_entered`)VALUES( 
NULL,'$_REQUEST[cetegory_id]','$_REQUEST[asset_branch_id]','$_REQUEST[asset_name]','$_REQUEST[asset_brand]','$_REQUEST[asset_model]','$_REQUEST[asset_serial]','$_REQUEST[asset_order_date]','$_REQUEST[asset_order_shop]','$_REQUEST[asset_order_no]','$_REQUEST[status]',NOW())"; 
$result = mysql_query($sql_query); 
$id = mysql_insert_id();
$barcode= str_pad($id, 6, "0", STR_PAD_LEFT);
$sql = "Update `asset`  SET `barcode` = '$barcode' Where `asset_id` = $id ";
mysql_query($sql);

$sql_query = "INSERT INTO `asset_log` (`asset_log_id`, `asset_id`, `old_owner_user_id`, `new_owner_user_id`, `time_start`, `datetime_entered`) VALUES (NULL, '$id', '0', '0', '', NOW());";
mysql_query($sql_query);

 ?>
<meta http-equiv="refresh" content="3; url=asset.php"  />
<? include("footer.php"); ?>
