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
	var bod = document.getElementById("bodyyyy").value+"-"+document.getElementById("bodmm").value+"-"+document.getElementById("boddd").value;
	document.getElementById("asset_order_date").value = bod;

document.getElementById("form1").submit();
}</script>
<form action=asset_doadd.php method=post id=form1 >
 <input type="hidden" name="asset_order_date" id="asset_order_date" />
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เพิ่มทรัพย์สิน</strong></td>
    </tr>
    <tr>
      <td width='30%'  align=right>หมวดหมู่</td>
      <td  align=left><select name="cetegory_id" id="cetegory_id" style="width:450px; font-size:30px;">
          <?php 
				$sql = "select * from `asset_category`";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo "<option value='".$row[asset_category_id]."'>".$row[asset_category_name]."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td  align=right>ประเภท</td>
      <td  align=left><select name="asset_type" style="width:450px; font-size:30px;">
          <option value=company>ทรัพย์สินส่วนกลาง</option>
          <option value=personal>ทรัพย์สินส่วนบุคคล</option>
        </select></td>
    </tr>
    <tr>
      <td  align=right>สาขา</td>
      <td  align=left>		<select name="asset_branch_id" id="asset_branch_id" style="width:450px; font-size:30px;" >
          <?php 
				$sql = "select * from `asset_branch`  ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo "<option value='".$row[asset_branch_id]."' $selected >".$row['asset_branch_name']."</option>";
				} 
			?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ชื่อทรัพย์สิน</td>
      <td  align=left><input type="text" name="asset_name" id="asset_name" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ยี่ห้อ</td>
      <td  align=left><input type="text" name="asset_brand" id="asset_brand" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>รุ่น</td>
      <td  align=left><input type="text" name="asset_model" id="asset_model" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>Serial Number </td>
      <td  align=left><input type="text" name="asset_serial" id="asset_serial" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>วันสั่งซื้อ</td>
      <td  align=left><select name="boddd" id="boddd" style="width:100px; font-size:30px;">
          <?
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == date("d")){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="bodmm" id="bodmm" style="width:180px; font-size:30px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					if($stri == date("m")){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="bodyyyy" id="bodyyyy" style="width:150px; font-size:30px;">
          <?
				$y = date("Y");
				$yth = $y+543;
				for($i=-5;$i<1;$i++){ 
			?>
          <option value="<?=$y+1?>" <? if($i == 0){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
		  <? } ?>
        </select></td>
    </tr>
    <tr>
      <td width='30%'  align=right>ร้าน</td>
      <td  align=left><input type="text" name="asset_order_shop" id="asset_order_shop" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>หมายเลขการสั่งซื้อ</td>
      <td  align=left><input type="text" name="asset_order_no" id="asset_order_no" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td  align=left><select name="status" style="width:450px; font-size:30px;">
          <option value=used>พร้อมใช้งาน</option>
          <option value=break>ไม่สามารถใช้งานได้</option>
        </select></td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>เพิ่มข้อมูล</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
</form>
<? include("footer.php"); ?>
