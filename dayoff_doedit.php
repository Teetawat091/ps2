<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "UPDATE `dayoff` SET`dayoff_name` = '$_REQUEST[dayoff_name]' Where `dayoff_id` = $_REQUEST[dayoff_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=dayoff.php"  />
<? include("footer.php"); ?>
