<? include("header.php");
$marr[] = "มกราคม";
$marr[] = "กุมภาพันธ์";
$marr[] = "มีนาคม";
$marr[] = "เมษายน";
$marr[] = "พฤษภาคม";
$marr[] = "มิถุนายน";
$marr[] = "กรกฎาคม";
$marr[] = "สิงหาคม";
$marr[] = "กันยายน";
$marr[] = "ตุลาคม";
$marr[] = "พฤศจิกายน";
$marr[] = "ธันวาคม";	

$darr[] = "อาทิตย์";
$darr[] = "จันทร์";
$darr[] = "อังคาร";
$darr[] = "พุธ";
$darr[] = "พฤหัสบดี";
$darr[] = "ศุกร์";
$darr[] = "เสาร์";

 ?>
<script>
function doSubmit(){
document.getElementById("form1").submit();
}</script>
<form action=asset_history.php method=get id=form1 >
 <input type="hidden" name="asset_order_date" id="asset_order_date" />
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>ตรวจสอบทรัพย์สิน</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>Barcode</td>
      <td  align=left><input type="text" name="Barcode" id="Barcode" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>ค้นหาข้อมูล</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
