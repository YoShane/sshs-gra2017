<?php require_once('./Connections/gra2017.php'); ?>
<?php
if (!isset($_SESSION)) { //檢查session設定狀態，未啟動就將它打開
  session_start();
} ?>
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

$colname_rs_album = "-1";
if (isset($_GET['No'])) {
  $colname_rs_album = $_GET['No'];
}

$query_rs_album = sprintf("SELECT * FROM album WHERE aId = %s", GetSQLValueString($gra2017, $colname_rs_album, "int"));
$rs_album = mysqli_query($gra2017, $query_rs_album);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = mysqli_num_rows($rs_album);

$colname_rs_photo = "-1";
if (isset($_GET['No'])) {
  $colname_rs_photo = $_GET['No'];
}

$query_rs_photo = sprintf("SELECT * FROM photo WHERE pLalbum = %s ORDER BY pType ASC,pId ASC", GetSQLValueString($gra2017, $colname_rs_photo, "int"));
$rs_photo = mysqli_query($gra2017, $query_rs_photo);
$row_rs_photo = mysqli_fetch_assoc($rs_photo);
$totalRows_rs_photo = mysqli_num_rows($rs_photo);

if ($totalRows_rs_photo == 0) {
	 header ('Content-type: text/html; charset=utf-8');
echo "<script>javascript:alert(\"目前本相簿沒有照片。\")</script>"; 
echo "<script>window.history.go(-1);</script>";}
  
  

$colname_rs_alltype = "-1";
if (isset($_GET['No'])) {
  $colname_rs_alltype = $_GET['No'];
}

$query_rs_alltype = sprintf("SELECT tName FROM type WHERE tLalbum = %s", GetSQLValueString($gra2017, $colname_rs_alltype, "int"));
$rs_alltype = mysqli_query($gra2017, $query_rs_alltype);
$row_rs_alltype = mysqli_fetch_assoc($rs_alltype);
$totalRows_rs_alltype = mysqli_num_rows($rs_alltype);


$query_rs_allalbum = "SELECT aId, aName FROM album ORDER BY aId ASC";
$rs_allalbum = mysqli_query($gra2017, $query_rs_allalbum);
$row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum);
$totalRows_rs_allalbum = mysqli_num_rows($rs_allalbum);
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
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
         
        
    </head>
  <body>
      
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
                                    <li>
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
                                              <?php } while ($row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum)); ?>
                                          
                                        </ul>
                      
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
            
          <!-- Main Start -->
            <div id="main" class="haslayout">
                <div class="container">
                    <div class="row">
                       <!-- Start -->
					<div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h1><?php echo $row_rs_album['aName']; ?><?php if($row_rs_album['aVideo']!=""){?><a href="#" onclick="chgFrame('<?php echo $row_rs_album['aVideo']; ?>')"> <i class="fa fa-video-camera"></i></a><?php } ?><?php if($_SESSION['MM_Username'] != ""){?>(<a href="server/index.php">管理</a>)<?php } ?></h1>
                                </div>
                               <?php if($row_rs_album['aNote'] != ""){ ?> <br><br> <div class="description" style="font-size:23px;">
                                            <p><?php echo $row_rs_album['aNote']; ?><?php if($row_rs_album['aAtime'] != ""){ ?>(<?php echo $row_rs_album['aAtime']; ?>)<?php } ?></p>
                                        </div><?php } ?>
                      </div>
                      
                      
                                        
                                        
				
                <!-- Album Start -->
                <section class="album haslayout">
                    <!-- 類別 -->
                    <div class="filter-nav">
                        <div class="container">
                            <div class="row">
                                <ul id="gallery-cats" class="option-set nav-justified">
                                    <li class="select"><a href="#" data-filter="*">全部</a></li>
                                    <?php do { ?>
                                    <li><a href="#" data-filter=".<?php echo $row_rs_alltype['tName']; ?>"><?php echo $row_rs_alltype['tName']; ?></a></li>
                                      <?php } while ($row_rs_alltype = mysqli_fetch_assoc($rs_alltype)); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- end 類別-->
                    <script type='text/javascript'>
     function chgFrame(url)
   {   var o=document.getElementById('myfrm');
           o.src=url;
         var $modal     = $('.ymodal');
            var HIDE_CLASS = 'is-hide';
            $modal.removeClass(HIDE_CLASS);
  }
</script>

  <script type='text/javascript'>
     function closeFrame()
   {       var $modal     = $('.ymodal');
            var HIDE_CLASS = 'is-hide';
             $modal.addClass(HIDE_CLASS);
  }
</script>

                    
                    <div id="portfolio-content" class="portfolio-content gallery isotope">
                    
                    
                    
                        <?php do { ?>
                        
                        
                       <?php 
                        $colname_rs_type = "-1";
if (isset($row_rs_photo['pType'])) {
  $colname_rs_type = $row_rs_photo['pType'];
}

$query_rs_type = sprintf("SELECT tName FROM type WHERE tId = %s", GetSQLValueString($gra2017, $colname_rs_type, "int"));
$rs_type = mysqli_query($gra2017, $query_rs_type);
$row_rs_type = mysqli_fetch_assoc($rs_type);
$totalRows_rs_type = mysqli_num_rows($rs_type); ?>


                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 gallery-item <?php echo $row_rs_type['tName']; ?>">
                            <div class="row">
                              <img src="server/Picture/photo/thumb/<?php echo $row_rs_photo['pFilename']; ?>" >
                              <div class="img-hover">
                                <div class="holder">
                                  <div class="icons"  style="margin-left:-15px;">
                                    <a class="icon" href="server/Picture/photo/<?php echo $row_rs_photo['pFilename']; ?>" data-rel="prettyPhoto[gallery1]"  title="<?php echo $row_rs_photo['pName']; ?>">
                                      <i class="fa fa-search"></i></a>
                                      
                                     
                                                                        
                                     
                                    </div>
                                  <span class="title"><?php echo $row_rs_photo['pName']; ?></span>
                                  </div>
                                </div>
                              </div>
                          </div>
                          
                          
                          <?php mysqli_free_result($rs_type); ?>
                          
                          <?php } while ($row_rs_photo = mysqli_fetch_assoc($rs_photo)); ?>
                        
      
                        
                    </div>
                </section>
                <!-- album End -->
                
                 <div class="ymodal is-hide">
            <iframe id='myfrm' width="90%" height="80%" src="" frameborder="0" allowfullscreen></iframe>
            <i class="modal-close js-modal-close fa fa-times" onClick="closeFrame();"></i>
        </div>
        
        
            </div>
            <!-- Main End -->
            
            	<!--  End -->
                    </div>
                </div></div>
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
mysqli_free_result($rs_album);

mysqli_free_result($rs_photo);

mysqli_free_result($rs_alltype);
?>
