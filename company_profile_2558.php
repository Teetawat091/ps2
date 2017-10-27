<? include("header.php"); ?>
<link href="css_gallery/lightgallery.css" rel="stylesheet">


<table border='0' style='width:100%; margin-top:15px; font-size:40px;' cellspacing='0' cellpadding='0' align='center' class='bordered'>
  <tr>
    <td align='left' style='padding-left:30px; font-size:40px; padding-right:30px;' valign='bottom'><strong>2558</strong><hr></td>
  </tr>
  <tr>
  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
  <tr>
    <td width="30%">    <ul id="lightgallery">
    <li  data-src="company_profile/2558/sriracha/GO/1.jpg" style=" list-style-type: none;" data-sub-html="<h1>งาน Grand Opening พลัส คอนโด ศรีราชา</h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2558/sriracha/GO/1.jpg" style="width:80%;"> </a> </li>
	
		<?
		$directory = "company_profile/2558/sriracha/GO/";
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=2;$i<= $filecount; $i++){
	?>
	    <li style="display:none;"  data-src="company_profile/2558/sriracha/GO/<? echo $i;  ?>.jpg" data-sub-html="<h1>งาน Grand Opening พลัส คอนโด ศรีราชา</h1>"> <a href=""> <img class="img-responsive" src="company_profile/2558/sriracha/GO/<? echo $i;  ?>.jpg"> </a> </li>
	<? } ?>
  </ul></td>
    <td valign="top"><strong>งาน Grand Opening พลัส คอนโด ศรีราชา</strong><br>ระหว่างวันที่ 19 กันยายน 2558<br><a href="company_profile/2558/sriracha/GO.rar" target="_blank">Download</a></td>
  </tr>
</table>
		</td>
  </tr>
  <tr><td style="padding-left:30px; padding-right:30px;"><hr ></td></tr>
    <tr>
  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
  <tr>
    <td width="30%"> <ul id="lightgallery1">
    <li  data-src="company_profile/2558/staff/Day1/49.jpg" style=" list-style-type: none;" data-sub-html="<h1>Staff Party ( 28 ตุลาคม 2558 )</h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2558/staff/Day1/49.jpg" style="width:80%;"> </a> </li>
	
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
	    <li style="display:none;"  data-src="company_profile/2558/staff/Day1/<? echo $i;  ?>.jpg" data-sub-html="<h1>Staff Party ( 28 ตุลาคม 2558 )</h1>"> <a href=""> <img class="img-responsive" src="company_profile/2558/staff/Day1/<? echo $i;  ?>.jpg"> </a> </li>
	<? }
	}	
	 ?>
  </ul></td>
    <td valign="top"><strong>Staff Party ( 28 ตุลาคม 2558 )</strong><br>ระหว่างวันที่ 28-30 ตุลาคม 2558<br><a href="company_profile/2558/staff/Day1.rar" target="_blank">Download</a></td>
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
    <li  data-src="company_profile/2558/staff/Day2/23.jpg" style=" list-style-type: none;" data-sub-html="<h1>Staff Party ( 29 ตุลาคม 2558 )</h1>"> <a href=""> <img class="img-responsive"  src="company_profile/2558/staff/Day2/23.jpg" style="width:80%;"> </a> </li>
	
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
	    <li style="display:none;"  data-src="company_profile/2558/staff/Day2/<? echo $i;  ?>.jpg" data-sub-html="<h1>Staff Party ( 29 ตุลาคม 2558 )</h1>"> <a href=""> <img class="img-responsive" src="company_profile/2558/staff/Day2/<? echo $i;  ?>.jpg"> </a> </li>
	<? }
	}	
	 ?>
  </ul></td>
    <td valign="top"><strong>Staff Party ( 29 ตุลาคม 2558 )</strong><br>ระหว่างวันที่ 28-30 ตุลาคม 2558<br><a href="company_profile/2558/staff/Day2.rar" target="_blank">Download</a></td>
  </tr>
</table>
		</td>
  </tr>
      <tr><td style="padding-left:30px; padding-right:30px;"><hr ></td></tr>
    <tr>
  		<td style='padding-left:30px; padding-right:30px;'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" font-size:34px;">
  <tr>
    <td width="30%"><img src="company_profile/2558/presentation.png" style="width:80%;"></td>
    <td valign="top"><strong>Presentation</strong><br>รวบรวมภาพกิจกรรมประจำปี 2558<br><a href="company_profile/2558/company_profile_2558.pdf" target="_blank">Download</a></td>
  </tr>
</table>
		</td>
  </tr>
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