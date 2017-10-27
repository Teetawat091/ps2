<? include("header.php"); ?>
<link href="css_gallery/lightgallery.css" rel="stylesheet">


<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px; padding-right:30px;' valign='bottom'><strong>2559 / สาขาศรีราชา</strong><hr></td>
  </tr>
  <tr>
  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">


  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
  <tr>
    <td width="30%"> <ul id="lightgallery1">
    <li  data-src="company_profile/2559/sriracha/Pancake_07_02_59/56.jpg" style=" list-style-type: none;" data-sub-html="<h1>Pancake</h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2559/sriracha/Pancake_07_02_59/56.jpg" style="width:80%;"> </a> </li>
	
		<?
		$directory = "company_profile/2559/sriracha/Pancake_07_02_59/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=1;$i<= $filecount; $i++){
		if($i != 56){
	?>
	    <li style="display:none;"  data-src="company_profile/2559/sriracha/Pancake_07_02_59/<? echo $i;  ?>.jpg" data-sub-html="<h1>Pancake</h1>"> <a href=""> <img class="img-responsive" src="company_profile/2559/sriracha/Pancake_07_02_59/<? echo $i;  ?>.jpg"> </a> </li>
	<? }
	}	
	 ?>
  </ul></td>
    <td valign="top"><strong>Pancake </strong><br>ระหว่างวันที่ 7 กุมภาพันธ์ 2559<br><a href="company_profile/2559/sriracha/Pancake_07_02_59.rar" target="_blank">Download</a></td>
  </tr>
</table>
		</td>
  </tr>
    <tr><td style="padding-left:30px; padding-right:30px;"><hr ></td></tr>
    <tr>
  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
  <tr>
    <td width="30%"><ul id="lightgallery2">
    <li  data-src="company_profile/2559/sriracha/QSNCC_10-13_03_59/1.jpg" style=" list-style-type: none;" data-sub-html="<h1>บูธมหกรรมบ้านและคอนโด ศูนย์ประชุมสิริกิต </h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2559/sriracha/QSNCC_10-13_03_59/1.jpg" style="width:80%;"> </a> </li>
	
		<?
		$directory = "company_profile/2559/sriracha/QSNCC_10-13_03_59/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=1;$i<= $filecount; $i++){
		if($i != 1){
	?>
	    <li style="display:none;"  data-src="company_profile/2559/sriracha/QSNCC_10-13_03_59/<? echo $i;  ?>.jpg" data-sub-html="<h1>บูธมหกรรมบ้านและคอนโด ศูนย์ประชุมสิริกิต /h1>"> <a href=""> <img class="img-responsive" src="company_profile/2559/sriracha/QSNCC_10-13_03_59/<? echo $i;  ?>.jpg"> </a> </li>
	<? }
	}	
	 ?>
  </ul></td>
    <td valign="top"><strong>บูธมหกรรมบ้านและคอนโด ศูนย์ประชุมสิริกิต</strong><br>ระหว่างวันที่ 10-13 มีนาคม 59<br><a href="company_profile/2559/sriracha/QSNCC_10-13_03_59.rar" target="_blank">Download</a></td>
  </tr>
</table>
		</td>

  </table>
  
  

  <? /*
  <div id="gallery1">
		<a href="company_profile/2558/staff/Day1/49.jpg" ><img src="company_profile/2558/staff/Day1/49.jpg" style="width:80%;"></a>

	<!-- 49 -->
		<?
		$directory = "company_profile/2558/staff/Day1/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=1;$i<= $filecount; $i++){
		if($i != 49){
	?>
	<a href="company_profile/2558/staff/Day1/<? echo $i;  ?>.jpg" style="display:none; visibility:hidden;"><img src="company_profile/2558/staff/Day1/<? echo $i;  ?>.jpg" style="width:80%;"></a>
	<? 
		}
	} ?>
	
	</div>
  <div id="gallery2">
	<!-- 23 -->
	
		<a href="company_profile/2558/staff/Day2/23.jpg" ><img src="company_profile/2558/staff/Day2/23.jpg" style="width:80%;"></a>
		<?
		$directory = "company_profile/2558/staff/Day2/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=1;$i<= $filecount; $i++){
		if($i != 23){
	?>
	<a href="company_profile/2558/staff/Day2/<? echo $i;  ?>.jpg" style="display:none; visibility:hidden;"><img src="company_profile/2558/staff/Day2/<? echo $i;  ?>.jpg" style="width:80%;"></a>
	<? 
		}
	} ?>	
	</div> */ ?>
<script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
			$('#lightgallery1').lightGallery();
			$('#lightgallery2').lightGallery();
        });
        </script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="js_gallery/lightgallery.js"></script>
<script src="js_gallery/lg-fullscreen.js"></script>
<script src="js_gallery/lg-thumbnail.js"></script>
<script src="js_gallery/lg-video.js"></script>
<script src="js_gallery/lg-autoplay.js"></script>
<script src="js_gallery/lg-zoom.js"></script>
<script src="js_gallery/lg-hash.js"></script>
<script src="js_gallery/lg-pager.js"></script>
<script src="js_gallery/jquery.mousewheel.min.js"></script>
<? include("footer.php"); ?>