<? include("header.php"); 
$marr[1] = "มกราคม";
$marr[2] = "กุมภาพันธ์";
$marr[3] = "มีนาคม";
$marr[4] = "เมษายน";
$marr[5] = "พฤษภาคม";
$marr[6] = "มิถุนายน";
$marr[7] = "กรกฎาคม";
$marr[8] = "สิงหาคม";
$marr[9] = "กันยายน";
$marr[10] = "ตุลาคม";
$marr[11] = "พฤศจิกายน";
$marr[12] = "ธันวาคม";	
?>
<script>
function doSubmit(){
	var bod = document.getElementById("bodyyyy").value+"-"+document.getElementById("bodmm").value+"-"+document.getElementById("boddd").value;
	document.getElementById("asset_tranfer_date").value = bod;
	document.getElementById("form1").submit();

}</script>

<form action=asset_dotranfer.php method=post id=form1 >
 <input type="hidden" name="asset_tranfer_date" id="asset_tranfer_date" />
  <table border='0' style='width:100%; margin-top:15px; font-size:30px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>ประวัติรับมอบทรัพย์สิน</strong></td>
    </tr>
    <?
	
if( $_REQUEST[asset_id] != ""){
	$as_id = $_REQUEST[asset_id];
	$sql_query = " select * from asset where asset_id = $as_id";
}
if( $_REQUEST[Barcode] != ""){
	$barcode = $_REQUEST[Barcode];
	$sql_query = " select * from asset where barcode = $barcode";
}

$result = mysql_query($sql_query);
$detail = mysql_fetch_array($result);
$num = mysql_num_rows($result);
if($num > 0){
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
				echo date("d",strtotime($detail[asset_order_date]))." ";
				$mm =  intval(date(" m ",strtotime($detail[asset_order_date])));
				echo $marr[$mm];
				echo " ".(date("Y",strtotime($detail[asset_order_date])) + 543);
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
	<?
	$sql = "select * from asset_log where asset_id = $detail[asset_id] AND new_owner_user_id != 0 ORDER BY  `asset_log`.`asset_log_id` ASC ";
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	if($num > 0){
		  $sql_u = "select * from user";
		  $res_u = mysql_query( $sql_u);
		  while($row_u= mysql_fetch_array($res_u)){
			$all_user_name[$row_u[user_id]] = $row_u['title'].$row_u['name']." ".$row_u[sname];
		  }
	}
	$i=1;
	while($row = mysql_fetch_array($res)){
	?>
    <tr>
      <td  align=right><? if($i==1){ ?>ผู้รับผิดชอบ <? } echo $i; ?>.</td>
      <td align=left><? echo $all_user_name[$row['new_owner_user_id']]." ";
	  				echo date("d",strtotime($row[time_start]))." ";
				$mm =  intval(date(" m ",strtotime($row[time_start])));
				echo $marr[$mm];
				echo " ".(date("Y",strtotime($row[time_start])) + 543);
				echo '&nbsp;';
				echo '<a href="'.$row[file_asset].'" target="_blank" ><img src="page.png" width=20   /></a>';
?></td>
    </tr>
<?
$i++; }
}else{

 ?>
    <tr>
      <td  colspan="2"  align="center">ไม่พบข้อมูลทรัพย์สิน</td>
    </tr>
 
 <? } ?>

      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="asset_id" value="<? echo $detail[asset_id]; ?>"   >
</form>
<? include("footer.php"); ?>
