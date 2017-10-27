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


<form action=asset_dotranfer.php method=post id=form1  enctype="multipart/form-data">
 <input type="hidden" name="asset_tranfer_date" id="asset_tranfer_date" />
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>รับมอบทรัพย์สิน</strong></td>
    </tr>
    <?
$sql_query = " select * from asset where asset_id = $_REQUEST[asset_id]";
$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
 ?>
    <tr>
      <td width='40%'  align=right>หมวดหมู่</td>
      <td align=left>
          <?php 
				$sql = "select * from `asset_category` where asset_category_id = '$detail[category_id]' ";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo $row[asset_category_name];
				} 
			?></td>
    </tr>
    <tr>
      <td  align=right>ประเภท</td>
      <td  align=left><? if($detail[asset_type] == 'personal'){?>ทรัพย์สินส่วนกลาง<? } ?>
	  <? if($detail[asset_type] == 'company'){?>ทรัพย์สินส่วนบุคคล<? } ?></td>
    </tr>
    <tr>
      <td  align=right>สาขา</td>
      <td  align=left>
          <?php 
				$sql = "select * from `asset_branch` where  asset_branch_id =  $detail[asset_branch_id]";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					echo $row['asset_branch_name'];
				} 
			?></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ชื่อทรัพย์สิน</td>
      <td align=left><? echo $detail[asset_name]; ?></td>
    </tr>
    <tr>
      <td width='30%'  align="right">ยี่ห้อ</td>
      <td align=left><? echo $detail[asset_brand]; ?></td>
    </tr>
    <tr>
      <td width='30%'  align="right">รุ่น</td>
      <td align=left><? echo $detail[asset_model]; ?></td>
    </tr>
    <tr>
      <td width='30%'  align=right>Serial Number </td>
      <td align=left><? echo $detail[asset_serial]; ?></td>
    </tr>
    <tr>
      <td width='30%'  align="right">วันสั่งซื้อ</td>
      <td  align=left>
          <?
		  		//$ex = explode("-",$detail[asset_order_date]);
				//echo $ex[2]." ".$marr[$ex[1]]." ".($ex[0]+543);
				echo date("d/m/y",strtotime($detail[asset_order_date]));
          ?>        </td>
      </td>
    </tr>
    <tr>
      <td width='30%'  align="right">ร้าน</td>
      <td align=left><? echo $detail[asset_order_shop]; ?></td>
    </tr>
    <tr>
      <td width='30%'  align="right">หมายเลขการสั่งซื้อ</td>
      <td align=left><? echo $detail[asset_order_no]; ?></td>
    </tr>
	    <tr>
      <td width='30%'  align=right>สถานะ</td>
      <td align=left> <? if($detail[status] == 'used'){?>พร้อมใช้งาน <? } ?>
          <? if($detail[status] == 'break'){?>ไม่สามารถใช้งานได้<? } ?></td>
    </tr>
    <tr>
      <td  align=right>ผู้รับผิดชอบ</td>
      <td align=left><select  style="width:450px; font-size:30px;" name="owner_user_id" id="owner_user_id">
	  <? 
	  	$sql = "SELECT * FROM  `position`";
	  	$res = mysql_query($sql);
		while($row = mysql_fetch_array($res)){
			$position_name[$row[position_id]] =  $row[position_name];
		}
		$sql = "SELECT * FROM  `user` Where user_status != 'retire' ";
		$result = mysql_query($sql); 
		while($row = mysql_fetch_array($result)){
				if($detail[owner_user_id] == $row[user_id]){
						$selected = 'selected="selected"';
					}else{
						$selected = '';
					}

					echo "<option value='".$row[user_id]."' $selected >".$row['title'].$row['name']." ".$row[sname]." ( ".$position_name[$row[position_id]]." ) </option>";
		}
	  ?>
	  </select></td>
    </tr>
    <tr>
      <td  align=right>วันส่งมอบ</td>
      <td align=left><select name="boddd" id="boddd" style="width:100px; font-size:30px;">
          <?	
		  		if($detail[owner_user_id] != 0){
		  			$ex = explode("-",$detail[time_start]);
					$tmp_time = $detail[time_start];
				}else{
		  			$ex = explode("-",$detail[asset_order_date]);
					$tmp_time = $detail[asset_order_date];
				}
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($stri == intval($ex[2])){
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
					if($stri == $ex[1]){
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
          <option value="<?=$y+$i?>" <? if( ($y+$i) == $ex[0]){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
          <? } ?>
        </select></td>
    </tr>
    <tr>
      <td  align=right>เอกสารรับมอบ</td>
      <td align=left><input type="file" name="file_asset"  /></td>
    </tr>
    <tr>
      <td  align=right>&nbsp;</td>
      <td align=left>&nbsp;</td>
    </tr>

    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px;'><strong>รับมอบทรัพย์สิน</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="asset_id" value="<? echo $detail[asset_id]; ?>"   >
</form>
<script>
function doSubmit(){
	var bod = document.getElementById("bodyyyy").value+"-"+document.getElementById("bodmm").value+"-"+document.getElementById("boddd").value;
	document.getElementById("asset_tranfer_date").value = bod;
	var x = new Date('<? echo date("Y-m-d",strtotime($tmp_time)); ?>');
	var y = new Date(bod);
	if(y < x){
		alert("กรุณาตรวจสอบวันรับมอบ");
	}else{
		document.getElementById("form1").submit();
	}
	
	//document.getElementById("form1").submit();

}</script>
<? include("footer.php"); ?>
