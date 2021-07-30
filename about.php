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


$query_rs_about = "SELECT * FROM about WHERE id = 1";
$rs_about = mysqli_query($gra2017, $query_rs_about);
$row_rs_about = mysqli_fetch_assoc($rs_about);
$totalRows_rs_about = mysqli_num_rows($rs_about);


$query_rs_aboutus = "SELECT * FROM aboutus WHERE id = 1";
$rs_aboutus = mysqli_query($gra2017, $query_rs_aboutus);
$row_rs_aboutus = mysqli_fetch_assoc($rs_aboutus);
$totalRows_rs_aboutus = mysqli_num_rows($rs_aboutus);


$query_rs_allalbum = "SELECT aId, aName FROM album ORDER BY aId ASC";
$rs_allalbum = mysqli_query($gra2017,$query_rs_allalbum );
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
    <body class="home">
      
        <div id="wrapper">
            <!-- 標題開始 -->
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
                                    <li class="active"><a href="about.php">關於</a></li>
                                   
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
          
            <!-- Main Start -->
            <div id="main" class="haslayout" style="margin-bottom:-50px;">
 <!-- About Couple Start -->
                <section class="about-couple haslayout" style="padding-top:50px;">
                    <div class="container">
                        <div class="row">
                            <div class="holder row">
                                <div class="col-sm-6 vertical-align-bottom">
                                    <img src="images/img2.png" alt="image description">
                                </div>
                                <div class="col-sm-6 vertical-align-bottom" style="margin-top:20px;">
                                    <div class="text-area">
                                        <div class="theme-heading">
                                            <h2>關於 XIN ● 啟程</h2>
                                        </div>
                                        <div class="description" style="text-align:left;">
                                            <p><?php echo $row_rs_about['content']; ?></p>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </section>
                
                <!-- About Couple End -->
 
                
              
                <!-- Contact Section -->
  <section class="about-couple haslayout" style="background:#f7f7f7;">
  <div class="container">
    <div class="row">
      <div class="text-area">
        <div class="theme-heading">
             <h2>聯絡我們</h2>
            </div>
            <div class="col-sm-8 col-sm-offset-2" >
        <table class="table table-borderless" >
          <tr>
            <td>主 辦 單 位</td>
            <td><?php echo $row_rs_aboutus['main1']; ?></td>
          </tr>
          <tr>
            <td></td>
            <td><?php echo $row_rs_aboutus['main2']; ?></td>
          </tr>
          <tr>
            <td>典 禮 主 題</td>
            <td><?php echo $row_rs_aboutus['theme']; ?></td>
          </tr>
          <tr>
            <td>典 禮 時 間</td>
            <td><?php echo $row_rs_aboutus['time']; ?></td>
          </tr>
          <tr>
            <td>典 禮 地 點</td>
            <td><?php echo $row_rs_aboutus['place']; ?></td>
          </tr>
          <tr>
            <td>聯 絡 電 話</td>
            <td><?php echo $row_rs_aboutus['tel1']; ?></td>
          </tr>
          <tr>
            <td></td>
            <td><?php echo $row_rs_aboutus['tel2']; ?></td>
          </tr>
        </table>
        </div>
       </div>
         <p align="center"><a class="theme-btn timeline-btn" href="https://www.facebook.com/sshsgra2017" target="_blank" style="text-decoration: none;">Facebook粉絲團</a><p>
        
         <br>
        <br>
        </div>
    </div>
  </section>
  <!--結束聯絡我們-->
                <!-- Gift Registration Start -->
                   <section class="about-couple haslayout">
                    <div class="container">
                        <div class="row" >
                            <div class="text-area col-sm-6 col-sm-offset-3"  style="margin-bottom:-50px;">
                                <div class="theme-heading">
                                    <h2>協辦單位</h2>
                                </div>
                               
                            </div>
                            
                            <ul class="store-logo"  >
                           
                                <li>
                                    <a href="http://www.taichung.gov.tw/" target="_blank">
                                        <img src="images/logo-01.jpg" >
                                    </a>
                                </li>
                                <li>
                                    <a href="http://www.xinshe.taichung.gov.tw/" target="_blank">
                                        <img src="images/logo-02.jpg" >
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.facebook.com/%E6%98%A5%E7%A6%8F%E8%98%AD%E8%8A%B1%E8%BE%B2%E5%A0%B4-543107322387574/" target="_blank">
                                        <img src="images/logo-03.jpg" >
                                    </a>
                                </li>
                                 
                         
                          
                        
                          <li>
                                    <a href="http://superiorcoffee.mmweb.tw/" target="_blank">
                                        <img src="images/logo-04.jpg" >
                                    </a>
                                </li>
                                 <li>
                                    <a href="https://www.facebook.com/%E5%8F%B0%E4%B8%AD%E6%96%B0%E7%A4%BE%E9%8E%AE%E5%AE%89%E5%AE%AE-%E4%B8%AD%E5%A3%87%E5%85%83%E5%B8%A5%E5%BB%9F-754402177975648/" target="_blank">
                                        <img src="images/logo-05.jpg" >
                                    </a>
                                </li>
                            </ul>
                            
                            
                        </div>
                    </div><br><br>
                </section>
                <!-- Gift Registration End -->
               

              
            </div>
            <!-- Main End --></div>
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
mysqli_free_result($rs_about);

mysqli_free_result($rs_aboutus);
?>
