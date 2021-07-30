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


$query_rs_album = "SELECT * FROM album";
$rs_album = mysqli_query($gra2017, $query_rs_album);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = mysqli_num_rows($rs_album);


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
                                    <li class="active"><a href="#">畢業相簿</a>  

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
          <?php $countalbum = $totalRows_rs_album;
					$rundouble = 0;$tempcount = 0;$count2 = 0;$check2M = 0;
					$tempcount = $countalbum/2;
					$rundouble = floor($tempcount);
					$tempcount = $countalbum % 2; ?>
                    
		<div id="main" class="haslayout" <?php if($tempcount == 1){ ?>style="margin-bottom:-900px;"<?php }else{ ?>style="margin-bottom:-450px;"<?php } ?>>
			<div class="container">
			  <div class="row">
					<!-- Album Head Start -->
					
					<div class="text-area col-sm-6 col-sm-offset-3">
                                <div class="theme-heading">
                                    <h1>畢業相簿<?php if($_SESSION['MM_Username'] != ""){?>(<a href="server/index.php">管理</a>)<?php } ?></h1>
                                </div>
                </div>
	
					<!-- Album Head End -->
                    
                  
                    
                    
					<!-- Memories Start -->
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
                    
                                     
                  
                    <?php do { $count2++;$check2M = $count2 % 2; 
 if($count2 < 2){$addw = "";}elseif($count2 > 6){$addw = "";}
 else{$addw = sprintf("%d",$count2);};
                    $colname_rs_albumpp = "-1"; //讀入封面
if (isset($row_rs_album['aId'])) {
  $colname_rs_albumpp = $row_rs_album['aId'];
}

$query_rs_albumpp = sprintf("SELECT * FROM albumpicture WHERE bLid = %s", GetSQLValueString($gra2017, $colname_rs_albumpp, "int"));
$rs_albumpp = mysqli_query($gra2017, $query_rs_albumpp);
$row_rs_albumpp = mysqli_fetch_assoc($rs_albumpp);
$totalRows_rs_albumpp = mysqli_num_rows($rs_albumpp); 
 ?>

                                                                            
       <?php if($rundouble>0){ $albumpp = 0; ?>
                      
                   <?php if($check2M == 1){ //第一筆
				   $id[0] = $row_rs_album['aId'];
				   $name[0] = $row_rs_album['aName'];
				   $link[0] = $row_rs_album['aLink'];
				   $video[0] = $row_rs_album['aVideo'];
				   $note[0] = $row_rs_album['aNote'];
				   $atime[0] = $row_rs_album['aAtime'];
				   $addww[0] = $addw;
				     do {
				   $img[0][$albumpp] = $row_rs_albumpp['bImg'];
				   $albumpp += 1;
				 } while ($row_rs_albumpp = mysqli_fetch_assoc($rs_albumpp)); 
                   mysqli_free_result($rs_albumpp);
				   	}else{ //第二筆
					$rundouble = $rundouble - 1;
					$id[1] = $row_rs_album['aId'];
				  $name[1] = $row_rs_album['aName'];
				   $link[1] = $row_rs_album['aLink'];
				   $video[1] = $row_rs_album['aVideo'];
				   $note[1] = $row_rs_album['aNote'];
				   $atime[1] = $row_rs_album['aAtime'];
				   $addww[1] = $addw;
				     do {
				   $img[1][$albumpp] = $row_rs_albumpp['bImg'];
				   $albumpp += 1;
				 } while ($row_rs_albumpp = mysqli_fetch_assoc($rs_albumpp));
				 mysqli_free_result($rs_albumpp); 
						 } ?>
                   
           <?php if($check2M == 0){//完成2次準備插入}    ?>   
                     <!--雙數開始 -->
  <div class="album album-two" style="margin-top:-350px;"> 
                                              
    <div class="gallery grid">
      
      
      <!--區塊1的黑色開始-->
      <div class="gallery-item gallery-box box-size-one love-story text-post">
        <span class="post-title">
          <a href="show-album.php?No=<?php echo $id[0]; ?>">
            <em><?php echo $name[0]; ?></em>
            <i class="fa fa-angle-right"></i>
            </a>
          </span>
        </div>
      <div class="gallery-item gallery-box box-size-two img-post">
        </div>
      <!--區塊1的黑色結束-->
      <!--區塊2 開始-->
      <div class="gallery-item gallery-box box-size-three img-post" style="margin:-380px 0 0 0;">
                <div class="gallery-post-detail">
          <div class="slider-post-head">
            <span class="date"><?php echo $atime[1]; ?></span>
            <?php if($video[1]!=""){?><a href="#" onclick="chgFrame('<?php echo $video[1]; ?>')"><i class="fa fa-video-camera"></i></a><?php } ?>
            </div>
          <div class="slider-post-title">
            <h3><span><a href="<?php echo $link[1]; ?>"><?php echo $note[1]; ?></a></span></h3>
            </div>
          </div>
          
                      	<div id="posttype-slider<?php echo $addww[1]; ?>">
           <?php $start = 0 ?>
            <?php foreach($img as $v1)
			{
				foreach($v1 as $v2)
				{ if($start == 1){?>
                	<div class="item">
										 <figure><a href="show-album.php?No=<?php echo $id[1]; ?>"><img src="server/Picture/albumimg/<?php echo $v2; ?>" ></a></figure>
									</div>
                <?php
				}			
}$start++;
			}
			?>
		</div>
        
       
        </div>
      <!--區塊2 粉紅結束-->
      
      <!--區塊1 黑色開始-->
      <div class="gallery-item gallery-box box-size-three slider-post" >
        <div class="gallery-post-detail">
          <div class="slider-post-head">
            <span class="date"><?php echo $atime[0]; ?></span>
            <?php if($video[0]!=""){?><a href="#" onclick="chgFrame('<?php echo $video[0]; ?>')"><i class="fa fa-video-camera"></i></a><?php } ?>
            </div>
          <div class="slider-post-title">
            <h3><span><a href="<?php echo $link[0]; ?>"><?php echo $note[0]; ?></a></span></h3>
            </div>
          </div>
        
        
                  	<div id="posttype-slider<?php echo $addww[0]; ?>">
          
  
           <?php $start = 0 ?>
            <?php foreach($img as $v1)
			{
				foreach($v1 as $v2)
				{ if($start == 0){?>
                	<div class="item">
										 <figure><a href="show-album.php?No=<?php echo $id[0]; ?>"><img src="server/Picture/albumimg/<?php echo $v2; ?>" ></a></figure>
				</div>
                <?php
				}			
}$start++;
			}
?>   
								</div>

                           
        </div>
      <div class="gallery-item gallery-box box-size-one img-post">
        </div>
      <div class="gallery-item gallery-box box-size-one slider-post">
        </div>
      <!--區塊1 黑色結束-->
      
      <!--區塊2紅色開始-->
      <div class="gallery-item gallery-box box-size-one more-story text-post" style="margin:-380px 0 0 0;">
        <span class="post-title">
          <a href="show-album.php?No=<?php echo $id[1]; ?>">
            <em><?php echo $name[1]; ?></em>
            <i class="fa fa-angle-right"></i>
            </a>
          </span>
        </div>
      <!--區塊2 紅色結束-->
      </div>
    
</div>
 
<!-- 12區塊 -->
                   
           <?php unset($img);    } ?>        
                                    
      <?php }elseif($tempcount==1){ ?><!--插入備-->
                            <?php $colname_rs_albumpp = "-1"; //讀入封面
if (isset($row_rs_album['aId'])) {
  $colname_rs_albumpp = $row_rs_album['aId'];
}

$query_rs_albumpp = sprintf("SELECT * FROM albumpicture WHERE bLid = %s", GetSQLValueString($gra2017, $colname_rs_albumpp, "int"));
$rs_albumpp = mysqli_query($gra2017, $query_rs_albumpp);
$row_rs_albumpp = mysqli_fetch_assoc($rs_albumpp);
$totalRows_rs_albumpp = mysqli_num_rows($rs_albumpp); 
 ?>                 
                    
                   
                        <!--區塊5 黑開始--><!--奇數補充 -->
                <div class="gallery grid" style="margin:-350px 0 0 0;">
							<div class="gallery-item gallery-box box-size-one love-story text-post">
								<span class="post-title">
									<a href="show-album.php?No=<?php echo $row_rs_album['aId']; ?>">
										<em><?php echo $row_rs_album['aName']; ?></em>
										<i class="fa fa-angle-right"></i>
									</a>
								</span>
							</div>
							<div class="gallery-item gallery-box box-size-two img-post">
							</div>
                            <!--區塊5 黑結束-->
                            
							<div class="gallery-item gallery-box box-size-three img-post" style="margin:-380px 0 0 0;">
								
							</div>
                            
                            <!--區塊5 開始-->
							<div class="gallery-item gallery-box box-size-three slider-post" >
								<div class="gallery-post-detail">
									<div class="slider-post-head">
										<span class="date"><?php echo $row_rs_album['aAtime']; ?></span>
										<?php if($row_rs_album['aVideo']!=""){?><a href="#" onclick="chgFrame('<?php echo $row_rs_album['aVideo']; ?>')"><i class="fa fa-video-camera"></i></a><?php } ?>
									</div>
									<div class="slider-post-title">
										<h3><span><a href="<?php echo $row_rs_album['aLink']; ?>"><?php echo $row_rs_album['aNote']; ?></a></span></h3>
									</div>
								</div>
                                
                                
                                
                                
                                          	<div id="posttype-slider<?php echo sprintf("%d",$addw); ?>">
            
            <?php do{ ?>
									<div class="item">
										 <figure><a href="show-album.php?No=<?php echo $row_rs_album['aId']; ?>"><img src="server/Picture/albumimg/<?php echo $row_rs_albumpp['bImg']; ?>" ></a></figure>
									</div>
							<?php	} while ($row_rs_albumpp = mysqli_fetch_assoc($rs_albumpp));
				 mysqli_free_result($rs_albumpp); ?>
                                
                                
								</div>
                                

                                
							</div>
							
							<div class="gallery-item gallery-box box-size-one img-post">
								
							</div>
							<div class="gallery-item gallery-box box-size-one slider-post">
							</div>
							
                            
				  </div>
					<!--區塊5 結束-->   
                      
        <?php } ?>
                                                   
                                      
                      <?php } while ($row_rs_album = mysqli_fetch_assoc($rs_album)); ?>
                      
 
				  <!-- Memories End -->
				</div>
			</div>
                    <div class="clearfix"></div>
		</div>
                <div class="clearfix"></div>
                
                <div class="ymodal is-hide">
            <iframe id='myfrm' width="90%" height="80%" src="" frameborder="0" allowfullscreen></iframe>
            <i class="modal-close js-modal-close fa fa-times" onClick="closeFrame();"></i>
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
	<!--<script src="js/jquery.isotope.min.js"></script>-->
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
mysqli_free_result($rs_album);

mysqli_free_result($rs_allalbum);
?>
