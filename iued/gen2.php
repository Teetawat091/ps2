<?
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpasswd = "12345";
		$dbname = $_POST[db];
		$conn  = mysql_pconnect($dbhost, $dbuser, $dbpasswd) or die("Could not connect database : Please Connect Internet " . mysql_error());
		mysql_select_db($dbname, $conn) or die("Could not select database : ".mysql_error());
		mysql_query("SET NAMES UTF8");
		$folder_name = "gen_".$dbname."".date('_h_i_s', time());
		$flgCreate = mkdir($folder_name);
		echo $connectcompelte = date('h:i:s', time());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    	<?
        	$sql = "show tables";
			$res = mysql_query($sql);
			//$row = mysql_fetch_array($res);
			while($row = mysql_fetch_array($res)){
				//"/gen_".$_POST[db]."/".
				
				// Select
				$strFileName = $folder_name."/".$row[0].".php";
				$objFopen = fopen($strFileName, 'w');
				
				$txt = file_get_contents('template_header.php');
				$txt .= "<br /><br /><table width=100% border=0><tr><td><h1>";
				$txt .=  $row[0]."\n";
				$txt .= "</h1></td><td align=right><a href=$row[0]_add.php class='blue large button'>Add Record</a> \n";
				$txt .= "</td></tr></table><br />";
					
					$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
					$res_col = mysql_query($sql_col);
					$txt .= '<? ';
					$txt .= " \n";
					$txt .= '$sql_query = "select * from ';
					$txt .= '`'.$row[0].'`';
					$txt .= '";';
					$txt .= " \n";
					$txt .= '$result = mysql_query($sql_query);';
					$txt .= " \n";
					$txt .= '?> ';
					$txt .= " \n";
					
					$txt .= "<table class=bordered>\n	<tr>";
					$txt .= " \n";
					$txt .= "		<th>No.</th>";
					
					$tmp_txt = " \n";
					$tmp_txt .= '		<th>&nbsp;</th>';
					$tmp_txt .= " \n";
					$tmp_txt .= '		<th>&nbsp;</th>';
					$tmp_txt .= " \n";
					$tmp_txt .= "\n	</tr>\n";
					$tmp_txt .= "\n";
					$tmp_txt .= '<?';
					$tmp_txt .= "\n";
					$tmp_txt .= '$i = 1;';
					$tmp_txt .= "\n";
					$tmp_txt .= 'while($arr = mysql_fetch_array($result)){';
					$tmp_txt .= "\n";
					$tmp_txt .= '?> ';
					$tmp_txt .= "\n	<tr>";
					$tmp_txt .= "\n";
					$tmp_txt .= '		<td><? echo $i; ?></td>';
					$i = 0;
					while($row_col = mysql_fetch_array($res_col)){
						$txt .= " \n";
						$txt .= "		<th>".$row_col[0]."</th>";
						$tmp_txt .= " \n";
						$tmp_txt .= '		<td><? echo $arr[';
						$tmp_txt .= "'".$row_col[0]."'";
						$tmp_txt .= ']; ?></td>';
						if($i == 0){
							$arr_col_name = $row_col[0];
						}
						$i++;
					}
					$tmp_txt .= " \n";
					$tmp_txt .= "		<td><div align=center><a href=$row[0]_edit.php?";
					$tmp_txt .= $arr_col_name.'=<? echo $arr[0] ?>';
					$tmp_txt .= "><img src='Editing-Edit-icon.png' width='20'   /></a></div></td>";
					$tmp_txt .= " \n";
					$tmp_txt .= "		<td><div align=center><a href=$row[0]_del.php?";
					$tmp_txt .= $arr_col_name.'=<? echo $arr[0] ?>';
					$tmp_txt .= "><img src='System-Delete-icon.png' width='20'   /></a></div></td>";
					$tmp_txt .= " \n";
					$tmp_txt .= "	</tr>";
					$tmp_txt .= "\n";
					$tmp_txt .= '<? $i++;';
					$tmp_txt .= " \n";
					$tmp_txt .= ' } ?>';
					$txt .= $tmp_txt;
					$txt .= "\n</table>";
					
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);
				
				
				// Add
				$strFileName = $folder_name."/".$row[0]."_add.php";
				$objFopen = fopen($strFileName, 'w');
				$txt = file_get_contents('template_header.php');
				
				$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
				$res_col = mysql_query($sql_col);
				$txt .= "<br /><div align='center'><div align='right' style='width:600px;'><h1>";
 				$txt .= $row[0];
				$txt .= '</h1><br /></div><script>';
				$txt .= 'function doSubmit(){';
				$txt .= 'document.getElementById("form1").submit();'; 	
				$txt .= '}';
				$txt .= '</script>';
				$txt .= "<form action=".$row[0]."_doadd.php method=post id=form1 >\n";
				$txt .= "<table class=bordered2>\n";
				$i = 0;
					while($row_col = mysql_fetch_array($res_col)){
						if($i > 0){
							$txt .= " \n";
							$txt .= "<tr><td>".$row_col[0]."</td>";
							$txt .= "\n";
							if (preg_match("/enum/i", $row_col[1])) {
								$ex = explode("'",$row_col[1]);
								$txt .= '<td><select name="'.$row_col[0].'">';
								for($n=0;$n<count($ex);$n++){
									if($ex[$n] != "enum(" && $ex[$n] != "," && $ex[$n] != ")"){
										$txt .= '<option value='.$ex[$n].'>'.$ex[$n].'</option>';
									}
								}
								$txt .= '</select>';		
							} else {
								$txt .= '<td><input type="text" name="'.$row_col[0].'" id="'.$row_col[0].'"  class="txt"  />';
							}
							$txt .= '</td></tr>';
						}
						$i++;
					}
				$txt .= "<tr>\n<td colspan=2 style='border-bottom: 0px;'><div align=center><a href='javascript:doSubmit()' class='blue large button' style='width:350px;'><h1>Submit</h1></a>\n</div></td>\n</tr>";
				$txt .= "\n</table>";
				$txt .= "\n</form></div>";
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);

				// Do Add
				$strFileName = $folder_name."/".$row[0]."_doadd.php";
				$objFopen = fopen($strFileName, 'w');
				$txt = file_get_contents('template_header.php');
				
				$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
				$res_col = mysql_query($sql_col);
 				$txt .= $row[0]." Adding..";
				$txt .= " \n";
				$txt .= '<?  $sql_query = "Insert Into `'.$row[0].'` (';
				$i = 1;
				$n = mysql_num_rows($res_col);
				while($row_col = mysql_fetch_array($res_col)){
					$txt .= "`".$row_col[0]."`";
					if($i == $n){
						$txt .= ')VALUES(';
					}else{
						$txt .= ',';	
					}
					$i++;
				}
				$txt .= " \n";
				$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
				$res_col = mysql_query($sql_col);
				$i = 1;
				$n = mysql_num_rows($res_col);
				while($row_col = mysql_fetch_array($res_col)){
					if($i==1){
						$txt .= "NULL";
					}else{
						$txt .= "'$";
						$txt .= "_REQUEST";
						$txt .= "[".$row_col[0]."]'";
					}
					if($i == $n){
						$txt .= ')';
					}else{
						$txt .= ',';	
					}
					$i++;
				}
				$txt .= '";';
				$txt .= " \n";
				$txt .= '$result = mysql_query($sql_query);';
				$txt .= " \n";
				$txt .= "\n ?>";
				$txt .= '<meta http-equiv="refresh" content="1; url='.$row[0].'.php"  />';
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);
				
				
				// Edit
				$strFileName = $folder_name."/".$row[0]."_edit.php";
				$objFopen = fopen($strFileName, 'w');
				$txt = file_get_contents('template_header.php');
				
				$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
				$res_col = mysql_query($sql_col);
				$txt .= "<br /><div align='center'><div align='right' style='width:600px;'><h1>";
 				$txt .= $row[0];
				$txt .= '</h1><br /></div><script>';
				$txt .= 'function doSubmit(){';
				$txt .= 'document.getElementById("form1").submit();'; 	
				$txt .= '}';
				$txt .= '</script>';
				$txt .= "<form action=".$row[0]."_doedit.php method=post id=form1 >\n";
				$txt .= '<?'; 
				$txt .= "\n";
				$txt .= '$sql_query = " select * from ';
				$txt .= $row[0].' where '.$arr_col_name.' = $_REQUEST['.$arr_col_name.']";';
				$txt .= "\n";
				$txt .= '$result = mysql_query($sql_query);';
				$txt .= "\n";
				$txt .= '$detail = mysql_fetch_array($result);';
				$txt .= "\n";
				$txt .= " ?>";
				$txt .= "<table class=bordered2>\n";
				$i = 0;
					while($row_col = mysql_fetch_array($res_col)){
						if($i > 0){
							$txt .= " \n";
							$txt .= "<tr><td>".$row_col[0]."</td>";
							$txt .= "\n";
							if (preg_match("/enum/i", $row_col[1])) {
								$ex = explode("'",$row_col[1]);
								$txt .= '<td><select name="'.$row_col[0].'">';
								for($n=0;$n<count($ex);$n++){
									if($ex[$n] != "enum(" && $ex[$n] != "," && $ex[$n] != ")"){
										$txt .= '<option value='.$ex[$n].'>'.$ex[$n].'</option>';
									}
								}
								$txt .= '</select>';		
							} else {
								$txt .= '<td><input type="text" name="'.$row_col[0].'" id="'.$row_col[0].'" value="<? echo $detail['.$row_col[0].']; ?>" class="txt" />';
							}
							$txt .= '</td></tr>';
						}else{
							$txt_tmp = '<input type="hidden" name="'.$arr_col_name.'" value="<? echo $detail['.$row_col[0].']; ?>"   >';
						}
						$i++;
					}
				$txt .= "<tr>\n<td colspan=2 style='border-bottom: 0px;'><div align=center><a href='javascript:doSubmit()' class='blue large button' style='width:350px;'><h1>Submit</h1></a>\n</div></td>\n</tr>";
				$txt .= "\n</table>";
				$txt .= $txt_tmp;
				$txt .= "\n</form>";
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);
				

				// Do Edit
				$strFileName = $folder_name."/".$row[0]."_doedit.php";
				$objFopen = fopen($strFileName, 'w');
				$txt = file_get_contents('template_header.php');
				
				$sql_col = "SHOW COLUMNS FROM $dbname.$row[0]";
				$res_col = mysql_query($sql_col);
 				$txt .= $row[0]." Editing..";
				$txt .= " \n";
				$txt .= '<?  $sql_query = "UPDATE `'.$row[0].'` SET';
				$i = 1;
				$n = mysql_num_rows($res_col);
				while($row_col = mysql_fetch_array($res_col)){
					if($i!=1){
						$txt .= "`".$row_col[0]."` = ";
						$txt .= "'$";
						$txt .= "_REQUEST";
						$txt .= "[".$row_col[0]."]' ";
						if($i != $n){
							$txt .= ' , ';
						}
					}
					$i++;
				}
				$txt .= 'Where `'.$arr_col_name.'` = $_REQUEST['.$arr_col_name.']";';
				$txt .= " \n";
				$txt .= '$result = mysql_query($sql_query);';
				$txt .= " \n";
				$txt .= "\n ?>";
				$txt .= '<meta http-equiv="refresh" content="1; url='.$row[0].'.php"  />';
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);
				
				/*
								
				// Delete
				$strFileName = $folder_name."/".$row[0]."_del.php";
				$objFopen = fopen($strFileName, 'w');
				$txt = file_get_contents('template_header.php');
 				$txt .= $row[0];
				$txt .= file_get_contents('template_footer.php');
				fwrite($objFopen, $txt);
				fclose($objFopen);
				*/
								
			}
		?>
       
<meta http-equiv="refresh" content="1; url=<? echo $folder_name; ?>"  />
</body>
</html>