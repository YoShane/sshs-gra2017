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


$query_rs_bless1 = "SELECT * FROM bless WHERE bLevel = 1 ORDER BY bOrder ASC";
$rs_bless1 = mysqli_query($gra2017, $query_rs_bless1);
$row_rs_bless1 = mysqli_fetch_assoc($rs_bless1);
$totalRows_rs_bless1 = mysqli_num_rows($rs_bless1);



$query_rs_bless0 = "SELECT * FROM bless WHERE bLevel = 0 ORDER BY bOrder ASC";
$rs_bless0 = mysqli_query($gra2017, $query_rs_bless0);
$row_rs_bless0 = mysqli_fetch_assoc($rs_bless0);
$totalRows_rs_bless0 = mysqli_num_rows($rs_bless0);


$query_rs_bless2 = "SELECT * FROM bless WHERE bLevel = 2 ORDER BY bOrder ASC";
$rs_bless2 = mysqli_query($gra2017, $query_rs_bless2);
$row_rs_bless2 = mysqli_fetch_assoc($rs_bless2);
$totalRows_rs_bless2 = mysqli_num_rows($rs_bless2);


$query_rs_allalbum = "SELECT aId, aName FROM album ORDER BY aId ASC";
$rs_allalbum = mysqli_query($gra2017, $query_rs_allalbum);
$row_rs_allalbum = mysqli_fetch_assoc($rs_allalbum);
$totalRows_rs_allalbum = mysqli_num_rows($rs_allalbum);


$query_rs_bless3 = "SELECT * FROM bless WHERE bLevel = 3 ORDER BY bOrder ASC";
$rs_bless3 = mysqli_query($gra2017, $query_rs_bless3);
$row_rs_bless3 = mysqli_fetch_assoc($rs_bless3);
$totalRows_rs_bless3 = mysqli_num_rows($rs_bless3);
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
                                    
                                    <li class="active"><a href="blessed.php">師長祝福</a></li>
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
          
           <!-- Page Banner Start -->
            <div class="page-banner haslayout parallax-window" data-parallax="scroll" data-bleed="100" data-speed="0.2" style="margin-top:20px;" >
                <div class="page-heading">
                    <div class="box">
                        <div class="container">
                            <div class="row">
                                <div class="theme-heading">
                                <br>
                                    <h1>師長祝福</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Banner End -->
            
            <!-- Main Start -->
            <div id="main" class="haslayout" style="margin-top:-180px;">
                <!-- Album Head Start -->
					
					<!-- Album Head End -->
                <!-- Story Start -->
               <?php $tea0 = 0 ?>
                <?php do { $tea0++; ?>
                
                <div class="story haslayout">
                    <div class="container">
                      <article class="row story-post">
                        <div class="row">
                        <?php $temp0 = $tea0 % 2; if($temp0 == 0 ) { ?>
                          <div class="col-md-7 col-sm-12 story-img vertical-align pull-right">
                          <?php } else { ?>
                           <div class="col-md-7 col-sm-12 story-img vertical-align">
                           <?php } ?>
                            <div class="overflow">
                              <a href="<?php echo $row_rs_bless0['bFb']; ?>" target="_blank">
                                <img class="img2" src="server/Picture/teaimg/<?php echo $row_rs_bless0['bFaceimg']; ?>" >
                              </a>
                              
                              </div>
                            </div>
                          <div class="col-md-5 col-sm-12 story-description vertical-align" >
                            <center><h2><?php echo $row_rs_bless0['bName']; ?></h2></center>
                            <div class="description"><br>
                              <?php echo $row_rs_bless0['bText']; ?><?php if($row_rs_bless0['bBlessimg'] != ""){ ?> │ <span class="reply"><a data-rel="prettyPhoto2" href="server/Picture/teawrit/<?php echo $row_rs_bless0['bBlessimg']; ?>" style="color:#8A0FB9;" >Show</a></span><?php } ?>
                              </div>
                            </div>
                          </div>
                        </article>
                      </div>
                  </div>
                  <?php } while ($row_rs_bless0 = mysqli_fetch_assoc($rs_bless0)); ?>
<!-- Close Persons Start -->
                <section class="closepersons haslayout" style="padding-top:10px;margin-bottom:-100px;<?php if($temp0 == 1 ) { ?>background:#f7f7f7;<?php } ?>">
                    <div class="container" >
                        <div class="row"><br>
                            <div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h2>班任導師祝福(國中)</h2>
                                </div>
                              
                            </div>
                            <div id="closepersons-slider" class="closepersons-slider haslayout">
                                <?php do { ?>
                                
                                <div class="item">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <span class="border-title"><?php echo $row_rs_bless1['bClass']; ?></span>
                                      <div class="person-pic">
                                        <img src="server/Picture/teaimg/<?php echo $row_rs_bless1['bFaceimg']; ?>" >
                                        <div class="img-hover">
                                          <div class="holder">
                                            <div class="icons">
                                              <a data-rel="prettyPhoto2" href="server/Picture/teaimg/<?php echo $row_rs_bless1['bFaceimg']; ?>" class="icon">
                                                <i class="fa fa-search"></i>
                                              </a>
                                              <?php if($row_rs_bless1['bFb'] != ""){ ?>
                                              <a href="<?php echo $row_rs_bless1['bFb']; ?>" class="icon" target="_blank">
                                                <i class="fa fa-facebook"></i>
                                              </a>
                                              <?php } ?>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <div class="description">
                                        <span class="name"><?php echo $row_rs_bless1['bName']; ?>  老師</span>
                                        <span class="relationship"><?php if($row_rs_bless1['bFname'] == ""){ ?>&nbsp;<?php } ?><?php echo $row_rs_bless1['bFname']; ?></span>
                                        <blockquote>
                                          <p style="text-align:left;"><?php echo $row_rs_bless1['bText']; ?><?php if($row_rs_bless1['bBlessimg'] != ""){ ?> │ <span class="reply"><a data-rel="prettyPhoto2" href="server/Picture/teawrit/<?php echo $row_rs_bless1['bBlessimg']; ?>" style="color:#8A0FB9;" >Show</a></span><?php } ?></p>
                                        </blockquote>
                                        </div>
                                      </div>
                                  </div>
                                  <?php } while ($row_rs_bless1 = mysqli_fetch_assoc($rs_bless1)); ?>
                       
                                        </div>
                                        </div>
                                        </div><br> <br></section>
                                      
                                       
                               <section class="closepersons haslayout"  style="padding-top:10px;margin-bottom:-120px;<?php if($temp0 == 0 ) { ?>background:#f7f7f7;<?php } ?>" >
                                       <div class="container">
                        <div class="row"><br> <br>
                                        
                                        
                                        <div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                               
                                    <h2>班任導師祝福(高中)</h2>
                                </div>
                               
                            </div>
                            <div id="closepersons-slider2" class="closepersons-slider haslayout">
                                <?php do { ?>
                                
                                <div class="item" >
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                      <span class="border-title"><?php echo $row_rs_bless2['bClass']; ?></span>
                                      <div class="person-pic">
                                        <img src="server/Picture/teaimg/<?php echo $row_rs_bless2['bFaceimg']; ?>" >
                                        <div class="img-hover">
                                          <div class="holder">
                                            <div class="icons">
                                              <a data-rel="prettyPhoto2" href="server/Picture/teaimg/<?php echo $row_rs_bless2['bFaceimg']; ?>" class="icon">
                                                <i class="fa fa-search"></i>
                                              </a>
                                              
                                               <?php if($row_rs_bless2['bFb'] != ""){ ?>
                                              <a href="<?php echo $row_rs_bless2['bFb']; ?>" class="icon" target="_blank">
                                                <i class="fa fa-facebook"></i>
                                              </a>
                                              <?php } ?>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <div class="description">
                                        <span class="name"><?php echo $row_rs_bless2['bName']; ?> 老師</span>
                                         <span class="relationship"><?php if($row_rs_bless2['bFname'] == ""){ ?>&nbsp;<?php } ?><?php echo $row_rs_bless2['bFname']; ?></span>
                                        <blockquote>
                                          <p style="text-align:left;"><?php echo $row_rs_bless2['bText']; ?><?php if($row_rs_bless2['bBlessimg'] != ""){ ?> │ <span class="reply"><a data-rel="prettyPhoto2" href="server/Picture/teawrit/<?php echo $row_rs_bless2['bBlessimg']; ?>" style="color:#8A0FB9;" >Show</a></span><?php } ?></p>
                                        </blockquote>
                                        </div>
                                      </div>
                                  </div>
                                  <?php } while ($row_rs_bless2 = mysqli_fetch_assoc($rs_bless2)); ?>
            
            
                               </div>
                               
                               
                        </div>
                   </div><br> <br>
                </section>
                
                
                 <section class="closepersons haslayout" style="padding-top:50px;margin-bottom:-50px;<?php if($temp0 == 1 ) { ?>background:#f7f7f7;<?php } ?>">
                    <div class="container" >
                        <div class="row"><br>
                            <div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h2>科任老師或其他</h2>
                                </div>
                              
                            </div>
                            <div id="closepersons-slider3" class="closepersons-slider haslayout">
                                <?php do { ?>
                                
                                <div class="item">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                      <?php if($row_rs_bless3['bClass'] != ""){ ?>
                                      <span class="border-title"><?php echo $row_rs_bless3['bClass']; ?></span> <?php } ?>
                                      <div class="person-pic">
                                        <img src="server/Picture/teaimg/<?php echo $row_rs_bless3['bFaceimg']; ?>" >
                                        <div class="img-hover">
                                          <div class="holder">
                                            <div class="icons">
                                              <a data-rel="prettyPhoto2" href="server/Picture/teaimg/<?php echo $row_rs_bless3['bFaceimg']; ?>" class="icon">
                                                <i class="fa fa-search"></i>
                                              </a>
                                              <?php if($row_rs_bless3['bFb'] != ""){ ?>
                                              <a href="<?php echo $row_rs_bless3['bFb']; ?>" class="icon" target="_blank">
                                                <i class="fa fa-facebook"></i>
                                              </a>
                                              <?php } ?>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <div class="description">
                                        <span class="name"><?php echo $row_rs_bless3['bName']; ?> 老師</span>
                                        <span class="relationship"><?php if($row_rs_bless3['bFname'] == ""){ ?>&nbsp;<?php } ?><?php echo $row_rs_bless3['bFname']; ?></span>
                                        <blockquote>
                                          <p style="text-align:left;"><?php echo $row_rs_bless3['bText']; ?><?php if($row_rs_bless3['bBlessimg'] != ""){ ?> │ <span class="reply"><a data-rel="prettyPhoto2" href="server/Picture/teawrit/<?php echo $row_rs_bless3['bBlessimg']; ?>" style="color:#8A0FB9;" >Show</a></span><?php } ?></p>
                                        </blockquote>
                                        </div>
                                      </div>
                                  </div>
                                  <?php } while ($row_rs_bless3 = mysqli_fetch_assoc($rs_bless3)); ?>
                       
                                        </div>
                                        </div>
                                        </div><br> <br></section>
                <!-- Close Persons End -->
                
                
           
                
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
mysqli_free_result($rs_bless1);

mysqli_free_result($rs_bless0);

mysqli_free_result($rs_bless2);

mysqli_free_result($rs_bless3);
?>
