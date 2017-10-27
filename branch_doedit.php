<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "UPDATE `branch` SET `branch_name` = '$_REQUEST[branch_name]'  , `branch_address` = '$_REQUEST[branch_address]'  , `branch_tel` = '$_REQUEST[branch_tel]'  , `branch_active` = '$_REQUEST[branch_active]'  , `datetime_entered` = NOW() Where `branch_id` = $_REQUEST[branch_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=branch.php"  />
<? include("footer.php"); ?>
