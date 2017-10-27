<? include("header.php"); 
date_default_timezone_set("Asia/Bangkok");

?>
<form action="dayoff_detail_update.php" method="post" id="form1">
<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px;' valign='bottom'><strong>ชุดวันหยุด : </strong><? echo $_REQUEST[dayoff_name]; ?></td>
    <td align='right' style='padding-right:30px;'><a onClick="doSubmit();" class='orange large button' style='text-align:center; height:30px; font-size:30px;'><strong>อัพเดทวันหยุด</strong></a></td>
  </tr>
  <? 
  

$monthNames[0]    =    'มกราคม';
$monthNames[1]    =    'กุมภาพันธ์';
$monthNames[2]    =    'มีนาคม';
$monthNames[3]    =    'เมษายน';
$monthNames[4]    =    'พฤษภาคม';
$monthNames[5]    =    'มิถุนายน';
$monthNames[6]    =    'กรกฎาคม';
$monthNames[7]    =    'สิงหาคม';
$monthNames[8]    =    'กันยายน ';
$monthNames[9]    =    'ตุลาคม';
$monthNames[10]    =    'พฤศจิกายน';
$monthNames[11]    =    'ธันวาคม';
if (!isset($_GET["m"])) $_GET["m"] = date("n");
if (!isset($_GET["y"])) $_GET["y"] = date("Y");
 
$currentMonth = $_GET["m"];
$currentYear = $_GET["y"];

$sql = "SELECT * FROM `dayoff_detail` WHERE `dayoff_detail_month` = $currentMonth AND `dayoff_detail_year` = $currentYear AND `dayoff_id` = $_REQUEST[dayoff_id]";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$all_dayoff = explode(",",$row[dayoff_detail_day]);
  
  
$p_year = $currentYear;
$n_year = $currentYear;
$p_month = $currentMonth-1;
$n_month = $currentMonth+1;
 
if ($p_month == 0 ) {
    $p_month = 12;
    $p_year = $currentYear - 1;
}
 
if ($n_month == 13 ) {
    $n_month = 1;

    $n_year = $currentYear + 1;
}
$days=array('1'=>"อาทิตย์",'2'=>"จันทร์",'3'=>"อังคาร",'4'=>"พุธ",'5'=>"พฤหัส",'6'=>"ศุกร์",'7'=>"เสาร์");

?>
  <tr>
    <td align='center' colspan='2'><br />
      <table  border="0" cellpadding="0" cellspacing="0" class="calendared" align="center" >
        <tr align="center">
          <th ><a href="<?php echo $_SERVER["PHP_SELF"] . "?dayoff_id=".$_REQUEST[dayoff_id]."&dayoff_name=".urlencode($_REQUEST['dayoff_name'])."&m=". $p_month . "&y=" . $p_year; ?>" ><img src="iconmonstr-arrow-28-icon_left.png" height="25" width="25" /></a> </th>
          <th colspan="5" style="border-left:none;"><span style="font-size:36px;"><B><?php echo $monthNames[$currentMonth-1].'</B></span><B> '.($currentYear+543); ?></B> </th>
          <th style="border-left:none;"><a href="<?php echo $_SERVER["PHP_SELF"]  . "?dayoff_id=".$_REQUEST[dayoff_id]."&dayoff_name=".urlencode($_REQUEST['dayoff_name'])."&m=". $n_month . "&y=" . $n_year; ?>"><img src="iconmonstr-arrow-28-icon.png"  height="25" width="25"/></a> </th>
        </tr>
        <tr>
          <?php for($i=1;$i<=7;$i++){ ?>
          <td align="center" width="142" class="nono" ><B><?php echo $days[$i]; ?></B></td>
          <?php } ?>
        </tr>
        <?php
$monthNames[0]    =    'มกราคม';
$monthNames[1]    =    'กุมภาพันธ์';
$monthNames[2]    =    'มีนาคม';
$monthNames[3]    =    'เมษายน';
$monthNames[4]    =    'พฤษภาคม';
$monthNames[5]    =    'มิถุนายน';
$monthNames[6]    =    'กรกฎาคม';
$monthNames[7]    =    'สิงหาคม';
$monthNames[8]    =    'กันยายน ';
$monthNames[9]    =    'ตุลาคม';
$monthNames[10]    =    'พฤศจิกายน';
$monthNames[11]    =    'ธันวาคม';
if (!isset($_GET["m"])) $_GET["m"] = date("n");
if (!isset($_GET["y"])) $_GET["y"] = date("Y");
 
$currentMonth = $_GET["m"];
$currentYear = $_GET["y"];
 
$p_year = $currentYear;
$n_year = $currentYear;
$p_month = $currentMonth-1;
$n_month = $currentMonth+1;
 
if ($p_month == 0 ) {
    $p_month = 12;
    $p_year = $currentYear - 1;
}
 
if ($n_month == 13 ) {
    $n_month = 1;

    $n_year = $currentYear + 1;
}
$days=array('1'=>"อาทิตย์",'2'=>"จันทร์",'3'=>"อังคาร",'4'=>"พุธ",'5'=>"พฤหัส",'6'=>"ศุกร์",'7'=>"เสาร์");
$timestamp = mktime(0,0,0,$currentMonth,1,$currentYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ){ 
		echo "<tr>";
		$ii = 0; 
	}
	$ii++;
    if($i < $startday){ 
		echo "<td class=nono>&nbsp;</td>"; 
	} else {
		 $thisday = mktime(0,0,0,$currentMonth,$i,$currentYear);
		 echo "<td style=' border-radius:0px; ";
		 if(in_array(($i - $startday + 1),$all_dayoff)){
		 echo " background:#A3C6A4; ";
		 }
		 echo "' ";
			echo "Onclick=add('".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'); id='td_".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'><input type='checkbox' name='datepicked[]'   style='display:none;' value='". ($i - $startday + 1) . "' id='".$currentYear."-".$currentMonth."-". ($i - $startday + 1) . "'";
		 if(in_array(($i - $startday + 1),$all_dayoff)){
		 echo " checked ";
		 }
		 echo  "  >".($i - $startday + 1) . "</td>";
	}
    if(($i % 7) == 6 ){ 
		echo "</tr>";
	}
	if($i == (($maxday+$startday)-1)){
		if(($ii - 7) != 0){
			for($iii=0;$iii<(7-$ii); $iii++){
			echo "<td class=nono>&nbsp;</td>";
			}
		}
		echo "</tr>";
	}
}//
?>
      </table>
      <br />
    </td>
  </tr>
</table>
<input type="hidden" name="dayoff_id" value="<? echo $_REQUEST[dayoff_id]; ?>"  />
<input type="hidden" name="dayoff_detail_year" value="<? echo $currentYear; ?>"  />
<input type="hidden" name="dayoff_detail_month" value="<? echo $currentMonth; ?>"  />
</form>
<script>
function add(date){
	if (document.getElementById(date).checked){
		document.getElementById(date).checked = false;
		document.getElementById('td_'+date).style.background = "";
	}else{
		document.getElementById(date).checked = true;
		document.getElementById('td_'+date).style.background = "#A3C6A4";
	}
}
function doSubmit(){
		document.getElementById("form1").submit(); 	
}

</script>

<? include("footer.php"); ?>
