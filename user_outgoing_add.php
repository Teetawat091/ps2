<? include('header.php'); //echo phpversion();?>
<html>
<style type="text/css">
html,body{
	height: 100%;
	font-family: 'Prompt', sans-serif;

}
	#php{
		background-color:  #DDDDDD;	
		height: 100%;
		font-size: 14px;
		

	}
	button,input[type = submit]{
		border-radius: 4px;
		border :1px solid:#ccc;
		background-color: #ff9900;
		font-weight: bold;
	}
	button:hover{
		background-color: #9900cc;
		box-shadow: 5px 2px 2px;
	}
	input[type = submit]:hover{
		background-color: #9900cc;
		box-shadow: 5px 2px 2px;
	}
</style>
<body class="col-lg-12 col-md-10 col-5" >
	<img src="pic/route.png" width="100%">
<div id="php">
<?php

function curl_get_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

//echo $_POST['realstart'];
$slat = explode(",",$_POST['realstart']);
$slat[0] = substr($slat[0],9);// ของเก่า7
$slat[1] = substr($slat[1],8);// ของเก่า6
$slat[1] = substr($slat[1],0,strlen($slat[1])-1);

//echo $slat[0].','.$slat[1].'<br>';

$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$slat[0].",".$slat[1]."&destinations=".$_POST['en']."&key=AIzaSyBHlC_bwi0D_b86YE0ZN1hnymItuDb_5N0";
//echo $url;
$originsstatus;// 0 ไม่มีการเปลี่ยนจุดเริ่มต้น 1 ไม่ได้เริ่มต้นจากสำนักงาน
$json = json_decode(curl_get_contents($url)); 
//$json = file_get_contents($url);
//print_r($json);
$data = json_encode($json);
//print_r($data);
$data = json_decode($data,TRUE);

//print_r($_POST);

$distance = $_POST['total'];
$dest = $data['destination_addresses'][0];
$origin = $data['origin_addresses'][0];
$dest_description;
$uid = $_POST['uid'];
    
if(isset($dest)==false){
	$dest_description = 1;

}
else{
	$dest_description = 0;
}
if ($_POST['index']>1) {
	$originsstatus = 1;
}
else{
	$originsstatus = 0;
}
//echo $originsstatus;
$datetime = $_POST['datetime'];
echo "Current Time : ".$datetime;

$endpos = explode(',',$_POST['en']);
$rate;

//print_r($_POST['dyroute']);
$stepurl = 'https://maps.googleapis.com/maps/api/directions/json?origin='.$slat[0].','.$slat[1].'&destination='.$_POST['en'].'&key=AIzaSyBHlC_bwi0D_b86YE0ZN1hnymItuDb_5N0';

//echo $stepurl;

$jsonsteps = json_decode(curl_get_contents($stepurl)); 
$stepdata = json_encode($jsonsteps);
$data = json_decode($stepdata,TRUE);

/*echo '<pre>';
var_dump ($data['routes'][0]['legs'][0]['steps']);
echo '</pre>';*/
$steps = $data['routes'][0]['legs'][0]['steps'];
//var_dump($steps);

$countstep =  count($steps);

$eachdistance [] = array();
$eachaction [] = array();
$eachstartlat [] = array();
$eachstartlng [] = array();
$eachendlat [] = array();
$eachendlng [] = array();

for($i=0;$i<$countstep;$i++){
	$eachdistance[$i]= $steps[$i]['distance']['text'];
	$eachaction[$i]= $steps[$i]['html_instructions'];
	$eachstartlat[$i] = $steps[$i]['start_location']['lat'];
	$eachstartlng[$i] =  $steps[$i]['start_location']['lng'];
	$eachendlat[$i] = $steps[$i]['end_location']['lat'];
	$eachendlng[$i] = $steps[$i]['end_location']['lng'];
	$eachaction[$i] = strip_tags($eachaction[$i]);
	
}

echo '<br>'."Distance : ".$distance." km";
echo '<br>';
echo 'From : '.$origin.'<br>';
echo 'To : '.$dest.'<br>'."Vihecle : ".$_POST['select'].'<br>';

$campus;

if (!$conn) {
    die("Connection failed: " . mysql_connect_error());
}
else {
	if($_POST['select'] == 'car'){
		$rate = 4.5;
	}
	elseif ($_POST['select'] == 'motercycle') {
		$rate = 2 ;
	}

	echo 'Cost : '.$distance*$rate ." bath".'<br>'.'<br>';
	echo "<input type='hidden' value = '".$distance*$rate."' name = 'cost'>";
	
	$newdbsql = " INSERT INTO `user_outgoing` (`user_outgoing_id`, `branch_id`, `user_id`, `origin_lat`, `origin_lng`, `origin_branch_description_id`, `destination_lat`, `destination_lng`, `destination_branch_description_id`, `vihecle_type`, `distance`, `rate`, `cost`, `status`, `datetime_enter`, `description`) VALUES (NULL,".$_POST['cam'].",".$uid.", '".$slat[0]."', '".$slat[1]."','".$originsstatus."', '".$endpos[0]."', '".$endpos[1]."', '".$dest_description."', '".$_POST['select']."', ".$distance.", ".$rate.", ".$distance*$rate.",'wait' ,'".$datetime."','".$_POST['descriptions']."')";
//echo $newdbsql;
	if (mysql_query($newdbsql)) {
		//echo "add to db complete".'<br>';
  
    }
 else {
    echo "Error: " . $newdbsql . "<br>" . mysql_error($conn);
}

$ogid;
$foridsql = "SELECT user_outgoing_id FROM user_outgoing WHERE datetime_enter = '".$datetime."'";
//echo $foridsql;
$result = mysql_query($foridsql);
if($result){
	 while ($arec= mysql_fetch_array($result)){
	 	//echo  "Outgoing id : ".$arec['user_outgoing_id']."<br>";
	 	$ogid=$arec['user_outgoing_id'];
	 }
	
}
//echo $ogid;

for($i=0;$i<$countstep;$i++){
	$sqlstep = "INSERT INTO `user_outgoing_detail`(user_outgoing_detail_id,user_outgoing_id,start_lat,start_lng,end_lat,end_lng,distance,instruction) VALUES (NULL,'".$ogid."','".$eachstartlat[$i]."','".$eachstartlng[$i]."','".$eachendlat[$i]."','".$eachendlng[$i]."','".$eachdistance[$i]."','".$eachaction[$i]."')";
	 $sqlstep;
	if(mysql_query($sqlstep)){
		//echo "complete";
	}
	else{
		echo "<br>"."fail";
	}
}
    
    $position;
    $bossmail;
    $bossid;
    $encodebossmail;
    $positionsql = "SELECT position_id,leave_apporve_id FROM user WHERE user_id=".$_SESSION[ss_user_id];
    //echo $positionsql;
    $pos = mysql_query($positionsql);
    if($pos){
    	while ($poss = mysql_fetch_array($pos)) {
    		$position = $poss['position_id'];
    		$bossid = $poss['leave_apporve_id'];
    	}
    }
    else{
    	echo "fail";
    }

    //print_r($bossid);
    $bossid = str_replace("[", "", $bossid);
    $bossid = str_replace("]", "", $bossid);				
    //var_dump($bossid);
    if(strpos($bossid, ",")!==false){
    	$bossid = explode(",", $bossid);
    	//echo count($bossid);
    	for($i=0;$i<count($bossid);$i++){
    		//echo $bossid[$i].'<br>';
    		$bossmailsql = "SELECT email FROM user WHERE user.user_id =".$bossid[$i];
    		//echo $bossmailsql;
    		$bossmailresult =  mysql_query($bossmailsql);
    		if($bossmailresult){
        		while ($mailres= mysql_fetch_array($bossmailresult)){
	 			$bossmail[$i]=$mailres['email'];
	 			//echo $bossmail[$i];
	 }
    }
    	}
    	
    }
    else{
    	for($i=0;$i<count($bossid);$i++){
    	//echo $bossid;
    	$bossmailsql = "SELECT email FROM user WHERE user.user_id =".$bossid;
    	//echo $bossmailsql;
    	$bossmailresult =  mysql_query($bossmailsql);
    	if($bossmailresult){
        	while ($mailres= mysql_fetch_array($bossmailresult)){	
	 		$bossmail[$i]=$mailres['email'];
	 	}
    }
    
    }
}
   /*echo '<pre>';
    echo var_dump($bossmail);
    echo '</pre>';*/
    $encodebossmail = json_encode($bossmail);
    	//echo $encodebossmail;
	}
mysql_close($conn);
?>
<a class="orange large button" href="#" onclick="document.getElementById('sendmail').submit()" style="font-size:40px;"><strong>ส่งเมล</strong></a>
<?

?>

<div style="float: left;">
<form method="get" action="user_sendmail.php" name="sendmail" id="sendmail">
	<input type="hidden" name="dt" value="<?php echo $ogid; ?>" >
    <input type="hidden" name="boss" value="" id="boss">
    <input type="hidden" name="description" id="description" value="<?php echo $_POST['descriptions']; ?>">


</form>

</div>	
</div>
</body>
<script type="text/javascript">

	var bmail = <?php echo $encodebossmail; ?>;
	console.log(bmail);
	console.log(document.getElementById('description').value);
	document.getElementById('boss').value = bmail;
	console.log(document.getElementById('boss').value);
	
</script>
</html>