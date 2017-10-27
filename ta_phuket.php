
<html>
<head>
<title>ThaiCreate.Com PHP & Read CSV</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<script>
function doConfirm() {
	var s = document.getElementById("stryyyy").value+"-"+document.getElementById("strmm").value+"-"+document.getElementById("strdd").value+" "+"00:00:00";
	var e = document.getElementById("toyyyy").value+"-"+document.getElementById("tomm").value+"-"+document.getElementById("todd").value+" "+"23:59:59";
	document.getElementById("fromdate").value = s;
	document.getElementById("todate").value = e;
	document.getElementById("form1").submit();
}
</script>
<?
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
?>
<form name="form1" id="form1" action="ta_phuket.php" method="post" enctype="multipart/form-data" >
<input type="hidden" name="fromdate"  id="fromdate" value="" />
<input type="hidden" name="todate" id="todate"value="" />

		<select name="strdd" id="strdd" style="width:60px;">
          <?
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($_REQUEST[strdd]){
						$strdd = $_REQUEST[strdd];
					}else{
						$strdd = date("d");
					}
					if($stri == $strdd){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="strmm" id="strmm" style="width:120px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					
					if($_REQUEST[strmm]){
						$strmm = $_REQUEST[strmm];
					}else{
						$strmm = date("m");
					}

					if($stri == $strmm){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="stryyyy" id="stryyyy" style="width:80px;">
          	<?
				$y = date("Y");
				$yth = $y+543;
				if($_REQUEST[stryyyy]){
					$stryyyy = $_REQUEST[stryyyy];
				}else{
					$stryyyy = date("Y");
				}
				for($i=-1;$i<1;$i++){ 
			?>
          <option value="<?=$y+$i?>" <? if(($y+$i) == $stryyyy){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
		  <? } ?>
        </select>	 &nbsp;&nbsp;&nbsp;ถึงวันที่&nbsp;&nbsp;&nbsp;
		<select name="todd" id="todd" style="width:60px;">
          <?
				for($i=1;$i<=31;$i++){
					if(strlen($i)==1){
						$stri = "0".$i;
					}
					else{
						$stri = $i;
					}
					if($_REQUEST[todd]){
						$todd = $_REQUEST[todd];
					}else{
						$todd = date("d");
					}
					if($stri == $todd){
						echo "<option value=\"$stri\" selected>$i</option>";
					}
					else{
						echo "<option value=\"$stri\" >$i</option>";
					}
				}
				?>
        </select>
        <select name="tomm" id="tomm" style="width:120px;">
          <?
				for($i=0;$i<12;$i++){
					$j = $i+1;
					if(strlen($j)==1){
						$stri = "0" . $j;
					}
					else{
						$stri = $j;
					}
					
					if($_REQUEST[tomm]){
						$tomm = $_REQUEST[tomm];
					}else{
						$tomm = date("m");
					}

					if($stri == $tomm){
					 echo "<option value=\"$stri\" selected>$marr[$i]</option>";
					}
					else{
					 echo "<option value=\"$stri\" >$marr[$i]</option>";
					}
				}
			?>
        </select>
        <select name="toyyyy" id="toyyyy" style="width:80px;">
          	<?
				$y = date("Y");
				$yth = $y+543;
				if($_REQUEST[toyyyy]){
					$toyyyy = $_REQUEST[toyyyy];
				}else{
					$toyyyy = date("Y");
				}
				for($i=-1;$i<1;$i++){ 
			?>
          <option value="<?=$y+$i?>" <? if(($y+$i) == $toyyyy){?> selected="selected" <? } ?>>
          <?=$yth+$i?>
          </option>
		  <? } ?>
        </select><br>
		<input type="file" name="file_attach" id="file_attach"   />
		<a href="#" class='button large orange' style='text-align:center; height:30px; font-size:30px; width:150px;' onClick="doConfirm();"><strong>Submit</strong></a>
		</form>

<hr style="width:800px;" align="left"/>
<? if($_POST[tomm]){
error_reporting(0);

if($_FILES['file_attach']['name']){
	$ext = explode('.',$_FILES['file_attach']['name']);
	$extension = $ext[1];
	$newname = rand(1000,9999)."_".time();
	$full_local_path = 'upload/'.$newname.".".$extension ;
	$sql_path = 'upload/'.$newname.".".$extension ;
	move_uploaded_file($_FILES['file_attach']['tmp_name'], $full_local_path);
}else{
	$full_local_path = "";
}

$start = strtotime($_POST[fromdate]);
$end = strtotime($_POST[todate]);

// start and end are seconds, so I convert it to days 
$diff = ($end - $start) / 86400; 
$arr_all_day = array();
for ($i = 0; $i <= $diff; $i++) {
    // just multiply 86400 and add it to $start
    // using strtotime('+1 day' ...) looks nice but is expensive.
    // you could also have a cumulative value, but this was quicker
    // to type
    $date = $start + ($i * 86400); 

   $arr_all_day[] = $date;

}

$objCSV = fopen($full_local_path, "r");
$i = 0;
$all_id = array();
$arr_date = array();
while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
	if($i > 0){
		$id = $objArr[0];
		if(!in_array($id,$all_id)){
			$all_id[] = $id;
		}
		$arr_no[$id] = $objArr[0];
		$arr[$id] = $objArr[1];
		$arr_dept[$id] = $objArr[2];
		
		
		/*
		$ex = explode(" ",$objArr[3]);
		$this_date = $ex[0];
		$this_time = $ex[1];
		$ex_date = explode("/",$this_date);
		$ex_time = explode(":",$this_time);
		$mk_date = mktime(0, 0, 0, $ex_date[1], $ex_date[0], $ex_date[2]);
		$mk_time = date("H:i",mktime($ex_time[0], $ex_time[1], 0, $ex_date[1], $ex_date[0], $ex_date[2]));
		
		$arr_date[$id][$mk_date] = 1;
		$arr_time[$id][$mk_date][] = $mk_time;
		
		*/
		$ex = explode(" ",$objArr[4]);
		for($ii=0;$ii<count($ex);$ii++){
			if($objArr[4] != ""){
				$this_date = $objArr[3];
				$this_time = $ex[$ii];
				$ex_date = explode("/",$this_date);
				$mk_date = mktime(0, 0, 0, $ex_date[1], $ex_date[0], $ex_date[2]);
				$ex_time = explode(":",$this_time);
				$mk_time = date("H:i",mktime($ex_time[0], $ex_time[1], 0, $ex_date[1], $ex_date[0], $ex_date[2]));
				$arr_date[$id][$mk_date] = 1;
				$arr_time[$id][$mk_date][] = $mk_time;	
			}	
		}


	}
	$i++;
}
?>
<table width="1400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>

<table width="800" border="1" cellspacing="0" cellpadding="0">
<tr>
<td width="100" >รหัสที่เครื่อง</td>
  <td>ชื่อ-นามสกุล</td>
  <td>แผนก</td>
  <td>วัน/เดือน/ปี</td>
  <td>เวลาเข้า</td>
  <td>เวลาออก</td>
 </tr>
<? 
for($n=0;$n<count($all_id);$n++){
	for($i=0; $i<count($arr_all_day); $i++){ ?>
	<tr>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$arr_no[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$arr[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$arr_dept[$all_id[$n]]); ?></td>
		<td ><? 
			echo  date("d/m/y",$arr_all_day[$i]);
			$this_time = $arr_all_day[$i];
		 ?></td>
		<td ><?
				$print_in = 0;
				if($arr_date[$all_id[$n]][$this_time] == 1 ){ 
					$ex_t = explode(":",$arr_time[$all_id[$n]][$this_time][0]);
					if($ex_t[0] < 12){
						if($ex_t[0] >= 8 &&  $ex_t[1] > 30){
							echo '<font color=red>'.$arr_time[$all_id[$n]][$this_time][0].'</font>';
							$diff = (strtotime($arr_time[$all_id[$n]][$this_time][0]) - strtotime("8:30")) / 60;
							$sum_late[$all_id[$n]]++;
							$sum_late_min[$all_id[$n]] += $diff;
						}else{
							echo $arr_time[$all_id[$n]][$this_time][0];
						}
						$print_in = 1;
					}else{ 
						echo '&nbsp;'; 
					} 
				}else{ 
					echo '&nbsp;'; 
				} 
		?></td>
		<td ><? if($arr_date[$all_id[$n]][$this_time] == 1 &&  (count($arr_time[$all_id[$n]][$this_time]) - 1) != 0){ 
					echo $arr_time[$all_id[$n]][$this_time][ count($arr_time[$all_id[$n]][$this_time]) - 1];
					if($print_in == 0){
						// ลืมแสกนเข้า 
						$sum_f_in[$all_id[$n]]++;
					}
				}else{
					$ex_t = explode(":",$arr_time[$all_id[$n]][$this_time][0]);
					if($ex_t[0] > 12){
						echo $arr_time[$all_id[$n]][$this_time][0]; 
						// ลืมแสกนเข้า 
						$sum_f_in[$all_id[$n]]++;
						
					}else{
						if($print_in == 1){
							$sum_f_out[$all_id[$n]]++;
						}
				 		echo '&nbsp;'; 
					}
				} ?></td>
	 </tr>
<? }
}

 ?>
</table></td>
    <td align="right" valign="top" ><table width="530" border="1" cellspacing="0" cellpadding="0">
<tr>
  <td>ชื่อ-นามสกุล</td>
  <td>แผนก</td>
  <td>สาย</td>
  <td>นาที</td>
  <td>ลืมแสกนเข้า</td>
  <td>ลืมแสกนออก</td>
 </tr>
<? 
for($n=0;$n<count($all_id);$n++){ ?>
	<tr>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$arr[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$arr_dept[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$sum_late[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$sum_late_min[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$sum_f_in[$all_id[$n]]); ?></td>
		<td ><? echo iconv("ISO-8859-11", "UTF-8",$sum_f_out[$all_id[$n]]); ?></td>
	 </tr>
<?
}

 ?>
</table></td>
  </tr>
</table>
<? } ?>
</body>
</html>
