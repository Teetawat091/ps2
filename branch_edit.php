<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=branch_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขข้อมูลสาขา</strong></td>
    </tr>
    <?
$sql_query = " select * from branch where branch_id = $_REQUEST[branch_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='30%'  align="right">สาขา</td>
      <td align=left><input type="text" name="branch_name" id="branch_name" value="<? echo $detail[branch_name]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ที่อยู่สาขา</td>
      <td align=left><input type="text" name="branch_address" id="branch_address" value="<? echo $detail[branch_address]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">เบอร์โทรศัพท์</td>
      <td align=left><input type="text" name="branch_tel" id="branch_tel" value="<? echo $detail[branch_tel]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">สถานะ</td>
      <td align=left><select name="branch_active"  style="width:450px; font-size:30px;">
          <option value=yes <? if($detail[branch_active] == "yes"){?> selected="selected" <? } ?>>ปกติ</option>
          <option value=no <? if($detail[branch_active] == "no"){?> selected="selected" <? } ?>>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขข้อมูลสาขา</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="branch_id" value="<? echo $detail[branch_id]; ?>"   >
</form>
<? include("footer.php"); ?>
