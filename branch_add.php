<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=branch_doadd.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มข้อมูลสาขา</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สาขา</td>
      <td  align=left><input type="text" name="branch_name" id="branch_name" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ที่อยู่สาขา</td>
      <td  align=left><input type="text" name="branch_address" id="branch_address" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>เบอร์โทรศัพท์</td>
      <td  align=left><input type="text" name="branch_tel" id="branch_tel" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td  align=left><select name="branch_active" style="width:450px; font-size:30px;">
          <option value=yes>ปกติ</option>
          <option value=no>ยกเลิก</option>
         </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มข้อมูลสาขา</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
