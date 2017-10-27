<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "UPDATE `asset` SET `category_id` = '$_REQUEST[category_id]',`asset_branch_id` =  '$_REQUEST[asset_branch_id]',`asset_type` =  '$_REQUEST[asset_type]', `asset_name` = '$_REQUEST[asset_name]'  , `asset_brand` = '$_REQUEST[asset_brand]'  , `asset_model` = '$_REQUEST[asset_model]'  , `asset_serial` = '$_REQUEST[asset_serial]'  , `asset_order_date` = '$_REQUEST[asset_order_date]'  , `asset_order_shop` = '$_REQUEST[asset_order_shop]'  , `asset_order_no` = '$_REQUEST[asset_order_no]'    , `status` = '$_REQUEST[status]'  Where `asset_id` = $_REQUEST[asset_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=asset.php"  />
<? include("footer.php"); ?>
