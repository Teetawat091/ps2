<?
	include('../db.php');
	
	
	
		function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut =array(
	"0"=>"",
	"1"=>"มกราคม",
	"2"=>"กุมภาพันธ์",
	"3"=>"มีนาคม",
	"4"=>"เมษายน",
	"5"=>"พฤษภาคม",
	"6"=>"มิถุนายน",	
	"7"=>"กรกฎาคม",
	"8"=>"สิงหาคม",
	"9"=>"กันยายน",
	"10"=>"ตุลาคม",
	"11"=>"พฤศจิกายน",
	"12"=>"ธันวาคม"					
);
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	
	
	
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/reset.css">
<!-- CSS reset -->
<link rel="stylesheet" href="css/style.css">
<!-- Resource style -->
<style>
	@font-face {
    font-family: 'psl_kittithadaspregular';
    src: url('../psl094sp-webfont.eot');
    src: url('../psl094sp-webfont.eot?#iefix') format('embedded-opentype'),
         url('../psl094sp-webfont.woff') format('woff'),
         url('../psl094sp-webfont.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;

}
	body {
		font-family:'psl_kittithadaspregular',Sans-Serif;

 	}
	.cd-timeline-content h2{
		font-size:36px;
	
	}
		.cd-timeline-content p{
		font-size:24px;
	
	}
	.cd-timeline-content .cd-date {
		font-size:36px;
		font-weight:bold;
	
	}
.cd-timeline-content .cd-read-more {
		font-size:22px;
		background:#3498db;
		
	
	}
	</style>
<link href="../css_gallery/lightgallery.css" rel="stylesheet">
<script src="js/modernizr.js"></script>
<!-- Modernizr -->
<title>Company Profile Timeline</title>
</head>
<body>
<header>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center"><a href="../main.php"><img src="../logo-serene.png" height="100" style="margin-top:20px;" /></a></td>
    </tr>
    <tr>
      <td align="center" ><div style="font-size:22px; font-weight:bold;  letter-spacing:2px; color:#FFFFFF;">Serene Property Management System 1.0<br>
        </div></td>
    </tr>
    <tr>
      <td align="center" >&nbsp;</td>
    </tr>
  </table>
</header>
<section id="cd-timeline" class="cd-container">
<?	
	$logo['HQ'] = 'http://sereneproperty.com/TH/new_menu/phuket.png';
	$logo['4'] = 'http://sereneproperty.com/TH/new_menu/hatyai.png';
	$logo['5'] = 'http://sereneproperty.com/TH/new_menu/surat.png';
	$logo['8'] = 'http://sereneproperty.com/TH/new_menu/sriracha.png';
	$logo['9'] = 'http://sereneproperty.com/TH/new_menu/ayutthaya.png';
	$b = 0;
	$sql = " SELECT * FROM  `timeline` ORDER BY  `timeline`.`date` DESC ";
	$res = mysql_query($sql );
	
	while($row =mysql_fetch_array($res)){	
	$b++;
?>
  <div class="cd-timeline-block">
    <div class="cd-timeline-img">
	
	<!-- <img src="img/cd-icon-picture.svg" alt="Picture"> -->
	<img src="<? echo $logo[$row[project]]; ?>">
	</div>
    <!-- cd-timeline-img -->
    <div class="cd-timeline-content">
      <h2><? echo $row[name]; ?></h2>
      <p><? echo $row[detail]; ?></p>
      <ul id="lightgallery<? echo $b; ?>">
        <li  data-src="../<? echo $row[path]; ?>1.jpg" style=" list-style-type: none;" data-sub-html="<h1 style=font-size:36px;><? echo $row[name]; ?></h1>"> <a href="" class="cd-read-more">Read more <img class="img-responsive" style="display:none;" src="../<? echo $row[path]; ?>1.jpg"> </a> </li>
        <? 
		$directory = "../".$row[path];
		$filecount = 0;
		$files = glob($directory . "*");
		if ($files){
		 $filecount = count($files);
		}
		for($i=2;$i<= $filecount; $i++){
	?>
        <li style="display:none;"  data-src="../<? echo $row[path]; ?><? echo $i;  ?>.jpg" data-sub-html="<h1  style=font-size:36px;><? echo $row[name]; ?></h1>"> <a href=""> <img class="img-responsive" src="../<? echo $row[path]; ?><? echo $i;  ?>.jpg"> </a> </li>
        <?  }   ?>
      </ul>
      <span class="cd-date"><? echo DateThai($row['date']); ?></span> </div>
    <!-- cd-timeline-content -->
  </div>
  <!-- cd-timeline-block -->
  
  <? } ?>

</section>
<!-- cd-timeline -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script>
<!-- Resource jQuery -->
<script type="text/javascript">
        $(document).ready(function(){
          	<? for($i=1;$i<=$b;$i++){ ?>
			$('#lightgallery<? echo $i; ?>').lightGallery({
				thumbnail: true
			});
			<? } ?>
        });
        </script>
<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="../js_gallery/lightgallery.js"></script>
<script src="../js_gallery/lg-fullscreen.js"></script>
<script src="../js_gallery/lg-thumbnail.js"></script>
<script src="../js_gallery/lg-video.js"></script>
<script src="../js_gallery/lg-autoplay.js"></script>
<script src="../js_gallery/lg-zoom.js"></script>
<script src="../js_gallery/lg-hash.js"></script>
<script src="../js_gallery/lg-pager.js"></script>
<script src="../js_gallery/jquery.mousewheel.min.js"></script>
</body>
</html>
