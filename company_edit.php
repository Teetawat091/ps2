<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=company_doedit.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>แก้ไขข้อมูลบริษัท</strong></td>
    </tr>
    <?
$sql_query = " select * from company where company_id = $_REQUEST[company_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='30%'  align="right">ชื่อบริษัท</td>
      <td align=left><input type="text" name="company_name" id="company_name" value="<? echo $detail[company_name]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ตัวย่อ</td>
      <td align=left><input type="text" name="company_aka" id="company_aka" value="<? echo $detail[company_aka]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ที่อยู่</td>
      <td align=left><input type="text" name="company_address" id="company_address" value="<? echo $detail[company_address]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">เบอร์โทร</td>
      <td align=left><input type="text" name="company_tel" id="company_tel" value="<? echo $detail[company_tel]; ?>"  style="width:450px; font-size:30px;" /></td>
    </tr>
    <tr>
      <td width='30%'  align="right">สถานะ</td>
      <td align=left><select name="company_active"  style="width:450px; font-size:30px;">
          <option value=yes <? if($detail[company_active] == "yes"){?> selected="selected" <? } ?>>ปกติ</option>
          <option value=no <? if($detail[company_active] == "no"){?> selected="selected" <? } ?>>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>แก้ไขข้อมูลบริษัท</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="company_id" value="<? echo $detail[company_id]; ?>"   >
</form>
<? include("footer.php"); ?>
