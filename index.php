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


$query_rs_new = "SELECT * FROM post ORDER BY pTime DESC";
$rs_new = mysqli_query($gra2017, $query_rs_new);
$row_rs_new = mysqli_fetch_assoc($rs_new);
$totalRows_rs_new = mysqli_num_rows($rs_new);

$query_rs_allalbum = "SELECT aId, aName FROM album ORDER BY aId ASC";
$rs_allalbum = mysqli_query($gra2017, $query_rs_allalbum);
$row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum);
$totalRows_rs_allalbum = mysqli_num_rows($rs_allalbum);

function TrimByLength2($str, $len, $word) { 
  $end = "";
  if (mb_strlen($str,"utf-8") > $len) $end = "...";
  $str = mb_substr($str, 0, $len,"UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
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
        <meta name="google-site-verification" content="3_BM7VM_2NRelRU1x6hpJQJSfzDTBMqSqH5Z_H-qYCg" />
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

                                     <ul class="dropdown" >
                                            <?php do { ?>
                                            <li><a href="show-album.php?No=<?php echo $row_rs_allalbum['aId']; ?>"><?php echo $row_rs_allalbum['aName']; ?></a></li>
                                              <?php } while ($row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum)); ?>  </ul>
                      
                                    </li>
                                   
                                    <li><a href="#" >粉絲專頁</a>
                                     <ul class="dropdown" >
                                            <li><a href="https://www.facebook.com/sshsgra2017" target="_blank">4717畢典</a></li>
                                            <li><a href="https://www.facebook.com/XIN-%E4%B8%AD%E4%BA%BA%E8%87%BA%E4%B8%AD%E5%B8%82%E7%AB%8B%E6%96%B0%E7%A4%BE%E9%AB%98%E7%B4%9A%E4%B8%AD%E5%AD%B8%E7%B2%89%E7%B5%B2%E5%9C%98-289299034600446/" target="_blank">XIN中人</a></li>
                                        </ul>
                                    
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <strong class="logo" ><a href="index.php"><img src="images/logo.png"></a></strong>
            </header>
            <!-- Header End -->
            <!-- Slider Start -->
            <div class="slider haslayout"  style="margin-top:50px;">
                <div class="slider-caption">
                    <div class="box">
                        <div class="holder">
                            <div class="frame">
                                <div class="border-title">
                                    <h1>新中<strong>&amp;</strong>47 17</h1>
                                </div>
                                <span style="font-family:Microsoft JhengHei;font-size:32px;">畢業典禮</span>
                                <span class="date" style="margin-top:5px;">June 13<sup>th</sup>, 2017</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="home-slider" class="home-slider">
                    <div class="item">
                        <img src="images/img2.jpg" >
                    </div>
                    <div class="item">
                        <img src="images/img1.jpg" >
                    </div>
                    <div class="item">
                        <img src="images/img3.jpg" >
                    </div>
                    <div class="item">
                        <img src="images/img4.jpg" >
                    </div>
                    <div class="item">
                        <img src="images/img5.jpg" >
                    </div>
                </div>
            </div>
            <!-- Slider End -->
                       
                
 <!-- Main Start -->
 <div id="main" class="haslayout">
                     
                       
  <!-- Event Information Start -->
    <div class="event-info haslayout">
                    <div class="container">

                            <div class="row">
                                <div class="col-sm-4 col-xs-6 message">
                                    <h3>XIN 啟程</h3>
                                    <p>準備好了嗎？親愛的新中人</p><p>畢業是學習的一處驛站，深吸一口氣，我們即將啟程！帶上你的勇氣和熱情，我們在夢想的旅程，不見不散
一天！</p>
                                </div>
                                <div class="col-sm-4 col-xs-6 event-detail">
                                    <ul>
                                    <li>
                                            <i class="fa fa-key"></i>
                                            <em>新社高中4717屆畢業典禮</em>
                                        </li>
                                        <li>
                                            <i class="fa fa-calendar-o"></i>
                                            <em>2017/06/13(星期二)</em>
                                        </li>
                                        <li>
                                            <i class="fa fa-clock-o"></i>
                                            <em>7:30 AM – 10:30 AM</em>
                                        </li>
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <address>台中市立新社高級中學</address>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-4 counter-timer">
                                    <div id="countdown"></div>
                                </div>
                            </div>
      </div>
                </div>
                <!-- Event Information End -->
                
        
             <div class="container">

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


      
                         <!-- 最新消息 -->
                        <div class="ceremony-timeline haslayout">
                            <span class="button-style top"></span>
                           <br>
                              <?php $count = 0;$temp = 0 ?>
                            
                            <?php do { ?>
                            
                         <?php $count += 1;$temp = $count % 2; if($temp == 0){?> 
                            <div class="col-sm-6 col-xs-6 ceremony">
                                <div class="row">
                                    <div class="col-lg-9 col-md-10 col-sm-10 box vertical-align">
                                        <div class="ceremony-img">
                                            <img src="server/Picture/<?php echo $row_rs_new['pFilename']; ?>" >
                                        </div>
                                        <div class="ceremony-detailbox">
                                            <div class="ceremony-date">
                                                <span class="day-date"><?php echo date('d',strtotime($row_rs_new['pTime']));?></span>
                                                <span class="month-year-time">
                                                    <i><?php echo date('M',strtotime($row_rs_new['pTime']));?> <?php echo date('Y',strtotime($row_rs_new['pTime']));?></i>
                                                   <br>
                                                </span>
                                            </div>
                                            <strong class="ceremony-title"><?php echo $row_rs_new['pTitle']; ?></strong>
                                            <div class="description">
                                                <p><?php echo $row_rs_new['pOutline']; ?></p>
                                           </div>
                                            <a class="theme-btn btn-addtocalendar<?php if($row_rs_new['pYoutube'] != ""){ ?>2<?php }else{ ?>3<?php } ?>" <?php if($row_rs_new['pYoutube'] != ""){ ?>onclick="chgFrame('<?php echo $row_rs_new['pYoutube']; ?>')" <?php }else{ ?> href="new.php?pIndex=<?php echo $row_rs_new['pIndex']; ?>" <?php } ?> ><?php if($row_rs_new['pYoutube'] != ""){ ?>觀看影片<i class="fa fa-play-circle"></i><?php }else{ ?> 詳細內容 <?php } ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-2 arrow-section vertical-align">
                                        <span class="round"></span>
                                    </div>
                                </div>
                            </div>
                            
               
                            <?php }else{ ?>
                            
                            <div class="col-sm-6 col-xs-6 ceremony">
                                <div class="row">
                                    <div class="col-lg-3 col-md-2 col-sm-2 arrow-section vertical-align">
                                        <span class="round"></span>
                                    </div>
                                    <div class="col-lg-9 col-md-10 col-sm-10 box vertical-align">
                                        <div class="ceremony-img">
                                           <img src="server/Picture/<?php echo $row_rs_new['pFilename']; ?>">
                                        </div>
                                        <div class="ceremony-detailbox">
                                            <div class="ceremony-date">
                                              
                                               <span class="day-date"><?php echo date('d',strtotime($row_rs_new['pTime']));?></span>
                                                <span class="month-year-time">
                                                    <i><?php echo date('M',strtotime($row_rs_new['pTime']));?> <?php echo date('Y',strtotime($row_rs_new['pTime']));?></i>
                                                    <br>         </span>
                                            </div>
                                            <strong class="ceremony-title"><?php echo $row_rs_new['pTitle']; ?></strong>
                                            <div class="description">
                                                <p><?php echo $row_rs_new['pOutline']; ?></p>
                                            </div>
                                            <a class="theme-btn btn-addtocalendar<?php if($row_rs_new['pYoutube'] != ""){ ?>2<?php }else{ ?>3<?php } ?>" <?php if($row_rs_new['pYoutube'] != ""){ ?>onclick="chgFrame('<?php echo $row_rs_new['pYoutube']; ?>')" <?php }else{ ?> href="new.php?pIndex=<?php echo $row_rs_new['pIndex']; ?>" <?php } ?> ><?php if($row_rs_new['pYoutube'] != ""){ ?>觀看影片<i class="fa fa-play-circle"></i><?php }else{ ?> 詳細內容 <?php } ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
             
                          <?php } ?>
                              
                              
                              <?php } while ($row_rs_new = mysqli_fetch_assoc($rs_new)); ?>
                            
                            <span class="button-style bottom"></span>
                        </div>
                        
                                               <!-- 最新消息區塊結束 -->
    </div>
          </div>
           
           
               
       <div class="ymodal is-hide">
            <iframe id='myfrm' width="90%" height="80%" src="" frameborder="0" allowfullscreen></iframe>
            <i class="modal-close js-modal-close fa fa-times" onClick="closeFrame();"></i>
        </div>
        
          <!-- Main End -->
           
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
