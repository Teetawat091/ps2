<? include("header.php"); ?>

<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='center' colspan='2' style=' font-size:60px; letter-spacing:2px;' height='300' valign='middle'><strong>ลบข้อมูลเรียบร้อยแล้ว</strong></td>
  </tr>
</table>
<? 
$sql = "Delete from dayleave where dayleave_id = '$_REQUEST[dayleave_id]'";
mysql_query($sql);

$sql = "Delete from dayleave_detail where dayleave_id = '$_REQUEST[dayleave_id]'";
mysql_query($sql);
?>
<meta http-equiv="refresh" content="1; url=report_leave_user.php?owner_user_id=<? echo $_REQUEST[owner_user_id]; ?>&year=<? echo $_REQUEST[year]; ?>&branch_id=<? echo $_REQUEST[branch_id]; ?>"  />
<? include("footer.php"); ?>
