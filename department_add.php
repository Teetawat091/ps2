<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=department_doadd.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มข้อมูลแผนก</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ชื่อแผนก</td>
      <td  align=left><input type="text" name="department_name" id="department_name" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td  align=left><select name="department_active" style="width:450px; font-size:30px;">
          <option value=yes>ปกติ</option>
          <option value=no>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มข้อมูลแผนก</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
