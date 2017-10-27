<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>แก้ไขปรับปรุงข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<?  $sql_query = "UPDATE `company` SET`company_name` = '$_REQUEST[company_name]'  , `company_aka` = '$_REQUEST[company_aka]', `company_address` = '$_REQUEST[company_address]'  , `company_tel` = '$_REQUEST[company_tel]'  , `company_active` = '$_REQUEST[company_active]'  , `datetime_entered` = NOW() Where `company_id` = $_REQUEST[company_id]"; 
$result = mysql_query($sql_query); 

 ?>
<meta http-equiv="refresh" content="1; url=company.php"  />
<? include("footer.php"); ?>
