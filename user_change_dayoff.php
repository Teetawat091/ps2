<?php include("header.php"); ?>
<script>function doSubmit(){
	var msg  = " ยืนยันการเปลี่ยนวันหยุดจาก ";
	msg += document.getElementById("dd").value+"/"+document.getElementById("my").value;
	msg += " เป็นวันที่ ";
	msg += document.getElementById("n_dd").value+"/"+document.getElementById("n_my").value;
	//alert(msg);
	//document.getElementById("form1").submit();
	if(confirm(msg)){
		document.getElementById("form1").submit();
	}

}</script>
<script>
	function changeURL(){
		window.location.href = "user_change_dayoff.php?my="+document.getElementById("my").value+"&n_my="+document.getElementById("n_my").value;
	}
</script>


<form action=user_dochange_dayoff.php method=post id=form1 >
  <table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px; font-size:40px;'><strong>เปลี่ยนวันหยุด</strong></td>
    </tr>
    <?php
	if (!isset($_GET["my"])){
		$_GET["m"] = date("n");
		$_GET["y"] = date("Y");
		$_REQUEST['my'] = date("n")."/".date("Y");

		$_GET["n_m"] = date("n");
		$_GET["n_y"] = date("Y");
		$_REQUEST['n_my'] = date("n")."/".date("Y");

	}else{
		$ex = explode("/",$_REQUEST['my']);
		$_GET["m"] = $ex[0];
		$_GET["y"] = $ex[1];

		$ex = explode("/",$_REQUEST['n_my']);
		$_GET["n_m"] = $ex[0];
		$_GET["n_y"] = $ex[1];

	}

$currentMonth = $_GET["m"];
$currentYear = $_GET["y"];

	$marr['1'] = "มกราคม";
	$marr['2'] = "กุมภาพันธ์";
	$marr['3'] = "มีนาคม";
	$marr['4'] = "เมษายน";
	$marr['5'] = "พฤษภาคม";
	$marr['6'] = "มิถุนายน";
	$marr['7'] = "กรกฎาคม";
	$marr['8'] = "สิงหาคม";
	$marr['9'] = "กันยายน";
	$marr['10'] = "ตุลาคม";
	$marr['11'] = "พฤศจิกายน";
	$marr['12'] = "ธันวาคม";
	function next_months( $base_time = null, $months = 1 )
	{

		if (is_null($base_time))
			$base_time = time();

		$x_months_to_the_future    = strtotime( "+" . $months . " months", $base_time );

		$month_before              = (int) date( "m", $base_time ) + 12 * (int) date( "Y", $base_time );
		$month_after               = (int) date( "m", $x_months_to_the_future ) + 12 * (int) date( "Y", $x_months_to_the_future );

		if ($month_after > $months + $month_before)
			$x_months_to_the_future = strtotime( date("Ym01His", $x_months_to_the_future) . " -1 day" );

		return $x_months_to_the_future;
	}

$sql = "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[ss_user_id]' ";
$res = mysqli_query($_SESSION['connect'],$sql);
$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
$approve_user_id = $row["leave_apporve_id"];



$sql_query = " select * from dayoff_detail where dayoff_id = '$_SESSION[ss_user_id]' AND `dayoff_detail_month` = $currentMonth AND `dayoff_detail_year` = $currentYear";
$result = mysqli_query($_SESSION['connect'],$sql_query);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$dayoff_detail_day = $row['dayoff_detail_day'];
}

 ?>
    <tr>
      <td width='30%'  align=right>วันหยุดเดิม : </td>
      <td align=left> วันที่
        <select name="dd" id="dd" style="width:60px; font-size:30px;" >
          <?php $ex = explode(',',$dayoff_detail_day);
			 for($i=0;$i<count($ex);$i++){

			 ?>
          <option value="<?php echo $ex[$i]; ?>"><?php echo $ex[$i]; ?></option>
				<?php } ?>
        </select>
        <select name="my" id="my" style="width:250px; font-size:30px;"   onchange="changeURL()">
          <?php
	$sql_query = " select * from dayoff_detail where dayoff_id = '$_SESSION[ss_user_id]' ORDER BY `dayoff_detail_year`,`dayoff_detail_month` ASC ";
	$result = $_SESSION['connect']->query($sql_query);
	  while($row = $result->fetch_array(MYSQLI_ASSOC)){
		if($_GET["m"] == $row['dayoff_detail_month'] && $_GET["y"] == $row['dayoff_detail_year']){
			$selected = 'selected="selected"';
		}else{
			$selected = '';
		}
		echo "<option value='".$row[dayoff_detail_month]."/".$row[dayoff_detail_year]."' $selected >".$marr[$row[dayoff_detail_month]]." ".($row[dayoff_detail_year]+543)."</option>";
    } ?>
        </select>      </td>
    </tr>

    <tr>
      <td width='30%'  align=right>วันหยุดใหม่ : </td>
      <td align=left> วันที่
	  <?php
	  	$months[1] = 'January';
		$months[2] = 'February';
		$months[3] = 'March';
		$months[4] = 'April';
		$months[5] = 'May';
		$months[6] = 'June';
		$months[7] = 'July';
		$months[8] = 'August';
		$months[9] = 'September';
		$months[10] = 'October';
		$months[11] = 'November';
		$months[12] = 'December';

		$sql_query = " select * from dayoff_detail where dayoff_id = '$_SESSION[ss_user_id]' AND `dayoff_detail_month` = '$_GET[n_m]' AND `dayoff_detail_year` = '$_GET[n_y]'";
		$result = $_SESSION['connect']->query($sql_query);
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$dayoff_detail_day = $row['dayoff_detail_day'];
		}



		$month_end = date('t', strtotime($months[$_GET["n_m"]].' 1, '.$_GET["n_y"]));
?>
        <select name="n_dd" id="n_dd" style="width:60px; font-size:30px;" >
          <?php
		  	$arr_all_day = explode(',',$dayoff_detail_day);
			 for($i=1;$i<=$month_end;$i++){
			 	if(!in_array($i,$arr_all_day)){
			 ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php }
		  }
		  ?>
        </select>
        <select name="n_my" id="n_my" style="width:250px; font-size:30px;"  onchange="changeURL()" >
          <?php
		$sql_query = " select * from dayoff_detail where dayoff_id = '$_SESSION[ss_user_id]' ORDER BY `dayoff_detail_year`,`dayoff_detail_month` ASC ";
		$result = $_SESSION['connect']->query($sql_query);
		  while($row = $result->fetch_array(MYSQLI_ASSOC)){
			if($_GET["n_m"] == $row[dayoff_detail_month] && $_GET["n_y"] == $row[dayoff_detail_year]){
				$selected = 'selected="selected"';
			}else{
				$selected = '';
			}
			echo "<option value='".$row[dayoff_detail_month]."/".$row[dayoff_detail_year]."' $selected >".$marr[$row[dayoff_detail_month]]." ".($row[dayoff_detail_year] +543)."</option>";
		} ?>
        </select></td>
    </tr>
	    <tr>
      <td  align=right>หมายเหตุ : </td>
      <td align=left><input type="text" name="dayoff_change_remark" id="dayoff_change_remark" style="width:450px; font-size:30px;"  /></td>
    </tr>
    <tr>
      <td align='center' colspan='2'>&nbsp;</td>
    </tr>
    <tr>
      <td align='center' colspan='2'><a class='orange large button' href='#' onclick='doSubmit()' style='font-size:40px; width:300px;'><strong>ส่งคำขอเปลี่ยนวันหยุด</strong></a></td>
    </tr>
    <tr>
      <td align='right' colspan='2' style='padding-right:30px;'>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="approve_user_id" value="<? echo $approve_user_id; ?>"  />
</form>
<?php include("footer.php"); ?>
