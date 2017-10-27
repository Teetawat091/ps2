<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "UPDATE `position` SET `department_id` = '$_REQUEST[department_id]'   , `position_level_id` = '$_REQUEST[position_level_id]'  , `position_name` = '$_REQUEST[position_name]' , `position_active` = '$_REQUEST[position_active]'  , `datetime_entered` = NOW() Where `position_id` = $_REQUEST[position_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=position.php"  />
<? include("footer.php"); ?>
