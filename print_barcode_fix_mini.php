<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

-->
</style>
<style type="text/css">
@media print{
 #no_print{display:none;}
 }
</style>
</head>
<body>
<table  border="1" cellpadding="0" cellspacing="0" style=" margin-top:0.1CM; font-size:12px; line-height:14px;" align="center">
  <? 
  			
			/* 
				00 : Phuket office
				01 : Plus 1
				02 : Plus 2
				
				10 : Hatyai Office
				11 : Plus 3
				12 : Plus 4
				13 : Plus 7
				
				20 : Surat
			
			*/

  		for($i=91;$i<94;$i++){
			$all_barocde .= "10".str_pad($i, 4, "0", STR_PAD_LEFT)."_";
		}
		
		$all_barocde = substr($all_barocde,0,strlen($all_barocde)-1);

  $ex = explode("_",$all_barocde);
  for($i=0;$i<count($ex);$i++){ ?>
  
	  <? if($i%3 == 0){ ?>
	  <tr >
	  <? } ?>
    <td style="width:4CM;" align="center" valign="middle"><table style="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="60" align="center"><img src="logo-serene.png" height="35" /></td>
          <td><img src="barcode/html/image.php?code=code128&amp;o=1&amp;t=20&amp;r=1&amp;text=<? echo $ex[$i]; ?>&amp;f=5&amp;a1=A&amp;a2="></td>
        </tr>
      </table></td>
	<? if($i%3 == 2){ ?>
	  </tr>
	  <? } ?>
  <? } ?>
</table>
</body>
</html>
