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
<table  border="1" cellpadding="0" cellspacing="0" style="width:19.5cm; margin-top:0.1CM; font-size:12px; line-height:14px;" align="center">
  <? 
		$all_barocde = substr($_REQUEST['all_barocde'],0,strlen($_REQUEST['all_barocde'])-1);

  $ex = explode("_",$all_barocde);
  for($i=0;$i<count($ex);$i++){ ?>
  
	  <? if($i%3 == 0){ ?>
	  <tr >
	  <? } ?>
    <td style="width:6.5CM;height:4CM;" align="center" valign="middle"><table style="width:6.37CM;" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="60" align="center"><img src="logo-serene.png" width="40" /></td>
          <td>SERENE PROPERTY AND DEVELOPMENT CO., LTD<br />
            Tel. 076-304352<br />
          Email info@sereneproperty.com </td>
        </tr>
        <tr>
          <td colspan="2" align="center"><br />
            <img src="barcode/html/image.php?code=code128&amp;o=1&amp;t=30&amp;r=1.5&amp;text=<? echo $ex[$i]; ?>&amp;f=5&amp;a1=A&amp;a2=" ></td>
        </tr>
      </table></td>
	<? if($i%3 == 2){ ?>
	  </tr>
	  <? } ?>
  <? } ?>
</table>
</body>
</html>
