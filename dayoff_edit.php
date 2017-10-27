<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=dayoff_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขชุดวันหยุด</strong></td>
    </tr>
    <?
$sql_query = " select * from dayoff where dayoff_id = $_REQUEST[dayoff_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='30%'  align=right>ชุดวันหยุด</td>
      <td align=left><input type="text" name="dayoff_name" id="dayoff_name" value="<? echo $detail[dayoff_name]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขชุดวันหยุด</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="dayoff_id" value="<? echo $detail[dayoff_id]; ?>"   >
</form>
<? include("footer.php"); ?>
