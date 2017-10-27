<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body >
<?
	$strTo = "pannawit@sereneproperty.com";
	$strSubject = "Test Send Email";
	$strHeader .= "MIME-Version: 1.0\r\n";
	$strHeader = "Content-type: text/html; charset=utf-8\r\n"; // or UTF-8 //
	$strHeader .= "From: Pannawit Chanprim<pannawit@sereneproperty.com>\r\n";
	$strMessage = "
    <table  border='0' cellspacing='10' cellpadding='0'
	align='left' bgcolor='#FFFFFF' style='margin-top: 0px;font-size:24px;'>
    <tr>
      <td align='center' colspan='2'>รายละเอียด การขออนุมัติลางาน</td>
    </tr>
		<tr><td colspan=2><hr/></td></tr>

	    <tr>
      <td width='40%' align='right'><b>ชื่อ-สกุล</b></td>
	  <td align='left' style='padding-left:10px;'>
	  นายนวพงศ์ ธราพร</td>
    </tr>
	    <tr>
      <td width='40%' align='right'><b>ตำแหน่ง</b></td>
	  <td align='left' style='padding-left:10px;'>Human Resources Manager</td>
    </tr>
    <tr>
      <td width='40%' align='right'><b>ประเภทการลา</b></td>
	  <td align='left' style='padding-left:10px;'>ลากิจ</td>
    </tr>
    <tr>
      <td align='right'><b>เวลาเริ่มลา</b></td>
	  <td align='left' style='padding-left:10px;'>-</td>
    </tr>
    <tr>
      <td align='right'><b>จำนวน</b></td>
	  <td align='left' style='padding-left:10px;'>4 วัน</td>
    </tr>
    <tr>
      <td align='right' valign='top'><b>รายละเอียด</b></td>
	  <td align='left' style='padding-left:10px;'>10 กุมภาพันธ์ 2557 <br>11 กุมภาพันธ์ 2557 <br>12 กุมภาพันธ์ 2557 <br>13 กุมภาพันธ์ 2557 <br></td>
    </tr>
    <tr>
      <td align='right'><b>เหตุผล</b></td>
	  <td align='left' style='padding-left:10px;'>ทดสอบ</td>
    </tr>
    <tr>
      <td align='right'><b>ไฟล์แนบ</b></td>
	  <td align='left' style='padding-left:10px;'><a href='upload/9958_1388648412.jpg'  target='_blank'>Download</a></td>
    </tr>
	<tr><td colspan=2><hr/></td></tr>
    <tr height=50>
      <td height=50 align='center' colspan='2' bgcolor='#1abc9c' ><a href=http://sereneproperty.com/ps/confirm.php style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>อนุมัติ</strong></a></td>
    </tr>
    <tr height=50>
      <td height=50 align='center' colspan='2' bgcolor='#e33100'><a  href=http://sereneproperty.com/ps/reject.php style='text-align:center; height:50px; font-size:30px;text-decoration: none;color:#FFFFFF;'><strong>ไม่อนุมัติ</strong></a></td>
    </tr>
  </table>";

	$flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		echo "Email Sending.";
	}
	else
	{
		echo "Email Can Not Send.";
	}
?><td 
</html>
