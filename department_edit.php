<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>

<form action=department_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขข้อมูลแผนก</strong></td>
    </tr>
    <?
$sql_query = " select * from department where department_id = $_REQUEST[department_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='30%'  align="right">ชื่อแผนก</td>
      <td align=left><input type="text" name="department_name" id="department_name" value="<? echo $detail[department_name]; ?>" style="width:450px; font-size:30px;"/></td>
    </tr>
    <tr>
      <td width='30%'  align="right">สถานะ</td>
      <td align=left><select name="department_active"  style="width:450px; font-size:30px;">
          <option value=yes <? if($detail[department_active] == "yes"){?> selected="selected" <? } ?>>ปกติ</option>
          <option value=no <? if($detail[department_active] == "no"){?> selected="selected" <? } ?>>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขข้อมูลแผนก</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="department_id" value="<? echo $detail[department_id]; ?>"   >
</form>
<? include("footer.php"); ?>
