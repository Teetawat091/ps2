<? include("header.php"); ?>
<script>function doSubmit(){document.getElementById("form1").submit();}</script>
<form action=company_doadd.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มข้อมูลบริษัท</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ชื่อบริษัท</td>
      <td  align=left><input type="text" name="company_name" id="company_name" style="width:450px; font-size:30px;"  /></td>
    </tr>
	    <tr>
      <td width='30%'  align=right>ตัวย่อ</td>
      <td  align=left><input type="text" name="company_aka" id="company_aka" style="width:450px; font-size:30px;"  /></td>
    </tr>

    <tr>
      <td width='30%'  align=right>ที่อยู่</td>
      <td  align=left><input type="text" name="company_address" id="company_address" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>เบอร์โทร</td>
      <td  align=left><input type="text" name="company_tel" id="company_tel" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td  align=left><select name="company_active" style="width:450px; font-size:30px;">
          <option value=yes>ปกติ</option>
          <option value=no>ยกเลิก</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มข้อมูลบริษัท</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
