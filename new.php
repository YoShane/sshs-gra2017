<?php require_once('./Connections/gra2017.php'); ?>


<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString( $gra2017, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($gra2017, $theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rs_new = "-1";
if (isset($_GET['pIndex'])) {
  $colname_rs_new = $_GET['pIndex'];
}

$query_rs_new = sprintf("SELECT * FROM post WHERE pIndex = %s", GetSQLValueString($gra2017, $colname_rs_new, "int"));
$rs_new = mysqli_query($gra2017, $query_rs_new);
$row_rs_new = mysqli_fetch_assoc($rs_new);
$totalRows_rs_new = mysqli_num_rows($rs_new);


$query_rs_allalbum = "SELECT aId, aName FROM album ORDER BY aId ASC";
$rs_allalbum = mysqli_query($gra2017, $query_rs_allalbum);
$row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum);
$totalRows_rs_allalbum = mysqli_num_rows($rs_allalbum);

 if ($totalRows_rs_new == 0) {
	  $needGoTo = "index.php";
  header(sprintf("Location: %s", $needGoTo));}

function TrimByLength2($str, $len, $word) { 
  $end = "";
  if (mb_strlen($str,"utf-8") > $len) $end = "...";
  $str = mb_substr($str, 0, $len,"UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}


function format_date($time){ //格式時間表示Function
	
	$t=time()-strtotime($time);
	if($t>0){$ba = '前';}else{$ba = '後';}

	$f=array(
	'31536000'=>'年',
	'2592000'=>'個月',
	'604800'=>'星期',
	'86400'=>'天',
	'3600'=>'小時',
	'60'=>'分鐘',
	'1'=>'秒'
	);
	
	foreach ($f as $k=>$v) {
		if (0 !=$c=floor(abs($t)/(int)$k)) {
			return $c.$v.$ba;
		}
	}
}
?>
<!doctype html>
	<html class="no-js" lang="zh-TW"> 
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>XIN●啟程</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/prettyPhoto.css">
        <link rel="stylesheet" href="css/jcf.css">
        <link rel="stylesheet" href="css/jquery.classycountdown.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/transitions.css">
        <link rel="stylesheet" href="css/color.css">
        <style type="text/css">
        body,td,th {
	font-family: "Open Sans", Arial, Helvetica, sans-serif;
}
a:link {
	color: #414141;
}
a:hover {
	color: #414141;
}
        </style>
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
         
        
    </head>
    
    
<body class="post-single">
      
        <div id="wrapper">
            <!-- Header Start -->
            <header id="header" class="haslayout">
                <div class="container">
                    <div class="row">
                        <nav id="nav">
                            <div class="navbar-header">
                            <div id="controlbar">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" data-position="fixed" >
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                              </div>
                            </div>
                           
                           <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="row">
                                    <li class="active">
                                        <a href="index.php">最新消息</a>
                                  </li>
                                    <li><a href="about.php">關於</a></li>
                                   
                                    <li><a href="ceremony.php">儀式流程</a></li>
                                      <li><a href="traffic.php">交通資訊</a></li>
                                      
                                    <li class="logo"><a href="index.php"><img src="images/logo.png" ></a></li>
                                  
                                     <li><a href="video.php">畢業影片</a></li>
                                    
                                    <li><a href="blessed.php">師長祝福</a></li>
                                    <li><a href="#">畢業相簿</a>  

                                     <ul class="dropdown">
                                            <?php do { ?>
                                            <li><a href="show-album.php?No=<?php echo $row_rs_allalbum['aId']; ?>"><?php echo $row_rs_allalbum['aName']; ?></a></li>
                                              <?php } while ($row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum)); ?>  </ul>
                      
                                    </li>
                                   
                                    <li><a href="#" >粉絲專頁</a>
                                     <ul class="dropdown">
                                            <li><a href="https://www.facebook.com/sshsgra2017" target="_blank">4717畢典</a></li>
                                            <li><a href="https://www.facebook.com/XIN-%E4%B8%AD%E4%BA%BA%E8%87%BA%E4%B8%AD%E5%B8%82%E7%AB%8B%E6%96%B0%E7%A4%BE%E9%AB%98%E7%B4%9A%E4%B8%AD%E5%AD%B8%E7%B2%89%E7%B5%B2%E5%9C%98-289299034600446/" target="_blank">XIN中人</a></li>
                                        </ul>
                                    
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <strong class="logo"><a href="index.php"><img src="images/logo.png"></a></strong>
            </header>
            <!-- Header End -->
	
	
	<!-- 內容區塊 -->
	<div class="blog-single app-pages app-section">
		<div class="container">
			<div class="entry">
			  <div class="user-date">
           <br>
              <br>
              <br>
				  <ul>
						<li><a><i class="fa fa-user"></i></a> 4717畢籌會</li><br>
						<li><a><i class="fa fa-clock-o"></i></a> <?php echo $row_rs_new['pTime']; ?>(<?php echo format_date($row_rs_new['pTime']); ?>)</li>
				</ul>
			  </div>
                <br>
				<h1 style="font-size:40px;"><a href=""><?php echo $row_rs_new['pTitle']; ?></a></h1>
				<p><?php echo $row_rs_new['pContent']; ?></p>
                
                 <br><br>
				<div class="share">
               
					<ul>
						<li><h3>我要分享</h3></li><br>
						<li><a href="javascript: void(window.open('http://www.facebook.com/share.php?u='.concat(encodeURIComponent(location.href)) ));"><i class="fa fa-facebook-square"></i></a></li>
						<li><a href="javascript: void(window.open('http://twitter.com/home/?status='.concat(encodeURIComponent(document.title)) .concat(' ') .concat(encodeURIComponent(location.href))));"><i class="fa fa-twitter-square"></i></a></li>
                        
						<li><a href="javascript: void(window.open('https://plus.google.com/share?url='.concat(encodeURIComponent(location.href)), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'));">
<i class="fa fa-google-plus-square"></i></a></li>
						<li><span><script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
<script type="text/javascript">
new media_line_me.LineButton({"pc":false,"lang":"zh-hant","type":"a"});
</script></span></li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
    </div>

	
	
	            <!-- Footer Start -->
            <footer id="footer" class="haslayout">
            <br>
            <center style="color:#FFF;font-size:20px;line-height:1.5;margin-bottom:-20px;">42642臺中市新社區復盛里中和街三段國中巷10號<br>
					TeL:04-25812116 <br>
					FAX:04-25810148<br>
					網路電話:070-910-5130</center>
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <span class="copyright-text">&copy;2017  愛麗絲主題. 新社高級中學17屆畢籌會</span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
       <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/parallax.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script src="js/jcf.js"></script>
        <script src="js/jcf.select.js"></script>
        <script src="js/jcf.radio.js"></script>
        <script src="js/jcf.checkbox.js"></script>
        <script src="js/isotope.pkgd.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/masonry-horizontal.js"></script>
        <script src="js/jquery.simpleWeather.js"></script>
        <script src="js/jquery.knob.js"></script>
        <script src="js/jquery.throttle.js"></script>
        <script src="js/jquery.classycountdown.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script src="js/gmap3.min.js"></script>
        <script src="js/circle-progress.js"></script>
        <script src="js/main.js"></script>
        <script src="js/section.js"></script>
         </body>
</html>
        <?php
mysqli_free_result($rs_new);
?>
