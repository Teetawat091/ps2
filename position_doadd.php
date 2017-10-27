<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>เพิ่มข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "Insert Into `position` (`position_id`,`department_id`,`position_level_id`,`position_name`,`position_active`,`datetime_entered`)VALUES( 
NULL,'$_REQUEST[department_id]','$_REQUEST[position_level_id]','$_REQUEST[position_name]','$_REQUEST[position_active]',NOW())"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="3; url=position.php"  />
<? include("footer.php"); ?>
