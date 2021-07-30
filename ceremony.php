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
    <body class="home2">
      
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
                                   
                                    <li class="active"><a href="ceremony.php">儀式流程</a></li>
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
           
            <!-- Main Start -->
            <div id="main" class="haslayout" style="margin-top:-100px;margin-bottom:-50px;">
                
 
                       <!-- Are Your Attending Start -->
                <section class="attending haslayout">
                    <div class="container">
                        <div class="row">
                            <div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h1>畢典儀式流程</h1>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2" style="margin-bottom:-50px;margin-top:50px;" >
                                <div class="row">
                                    <div class="box">
                                        <div class="holder">
                                            <div class="frame">
                                              <img src="images/table.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                 <section class="attending haslayout" style="padding-top:40px;margin-bottom:-150px;background:#f7f7f7;">
                    <div class="container">
                        <div class="row">
                            <div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h1>場地座位表</h1>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2" style="margin-bottom:-50px;margin-top:50px;">
                                <div class="row">
                                   
                                              <img src="images/sit.png">
                                           
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Are Your Attending End -->
                 <section class="attending haslayout" style="padding-top:200px;">
                    <div class="container">
                        <div class="row">
                            <div class="text-area col-sm-6 col-sm-offset-3"  >
                                <div class="theme-heading">
                                    <h1>邀請卡</h1>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2" style="margin-bottom:-50px;margin-top:50px;" >
                                <div class="row">

                                              <img src="images/card1.png">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                
                 <section class="attending haslayout" style="padding-top:50px;margin-bottom:-120px;background:#f7f7f7;">
                    <div class="container">
                        <div class="row">
                            <div class="text-area col-sm-6 col-sm-offset-3" style="margin-bottom:50px;">
                                <div class="theme-heading">
                                    <h1>畢冊封面</h1>
                                </div>
                            </div>
                            <div class="col-sm-8 col-sm-offset-2" >
                                <div class="row">

                                              <img src="images/2017.png">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                                        
                </div>
            
            <!-- Main End --></div>
 <!-- Footer Start -->
            <footer id="footer" class="haslayout">
            <br>
            <center style="color:#FFF;font-size:20px;line-height:1.5;margin-bottom:-20px;">42642臺中市新社區復盛里中和街三段國中巷10號<br>
					TeL:04-25812116 <br>
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
    </body>
</html>
	<?php
mysqli_free_result($rs_allalbum);
?>
