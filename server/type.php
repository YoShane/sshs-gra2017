<?php

function TrimByLength2($str, $len, $word) { //割取字串Function(防止文字輸入過多)
  $end = "";
  if (mb_strlen($str,"utf-8") > $len) $end = "...";
  $str = mb_substr($str, 0, $len,"UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}

//資料集分頁Function
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
                GLOBAL $maxRows_rs_album,$totalRows_rs_album;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			//檢查目前頁碼位置
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_rs_album") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_album=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			//頁碼
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs_album) + 1;
					$max_l = ($a*$maxRows_rs_album >= $totalRows_rs_album) ? $totalRows_rs_album : ($a*$maxRows_rs_album);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_album=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_album=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?>
<?php require_once('../Connections/gra2017.php'); ?>
<?php
if (!isset($_SESSION)) { //檢查session設定狀態，未啟動就將它打開
  session_start();
}
//授權使用者清單
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "false";

//限制訪問頁面Function
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
   //宣告都未被授權
  $isValid = False;
  if (!empty($UserName)) {
	  $arrUsers = Explode(",", $strUsers); $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    }if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   //呼叫Function進行檢查
$MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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
$rs_album = mysqli_query($query_rs_album, $gra2017);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = "-1";

$colname_rs_album = "-1";
if (isset($_GET['aId'])) {
  $colname_rs_album = $_GET['aId'];
}


$query_rs_album = sprintf("SELECT aId, aName FROM album WHERE aId = %s", GetSQLValueString($gra2017, $colname_rs_album, "int"));
$rs_album = mysqli_query($query_rs_album, $gra2017);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = mysqli_num_rows($rs_album);

$colname_rs_type = "-1";
if (isset($_GET['aId'])) {
  $colname_rs_type = $_GET['aId'];
}

$query_rs_type = sprintf("SELECT * FROM type WHERE tLalbum = %s", GetSQLValueString($gra2017, $colname_rs_type, "int"));
$rs_type = mysqli_query($query_rs_type, $gra2017);
$row_rs_type = mysqli_fetch_assoc($rs_type);
$totalRows_rs_type = mysqli_num_rows($rs_type);
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>4717管理介面</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="../../css/style.css" />
   <script type="text/javascript" src="../../js/modernizr-1.5.min.js"></script>
   <script type="text/javascript">
function tfm_confirmLink(message) { //v1.0
	if(message == "") message = "Ok to continue?";	
	document.MM_returnValue = confirm(message);
}
</script>
  <style type="text/css">
  body,td,th {
	font-size: 0.8em;
}
a:link {
	color: hsla(200,59%,50%,1);
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: hsla(200,59%,50%,1);
}
a:hover {
	text-decoration: underline;
	color: hsla(218,73%,40%,1);
}
a:active {
	text-decoration: none;
}
  </style>
  <link rel="shortcut icon" href="/favicon.ico" type="image/png" />
 
 <style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
  </style></head>

<body>
<!-- 透過網站編輯軟體Dreamweaver可針對CSS元素點擊右鍵->程式碼導覽器->點擊裡面對應到的ID.CLASS等設定即可切換至該CSS語法設定位置 -->
<div id="top"></div>
<div id="container">
    
    <div id="main">
      <div id="site_content">
        <div id="sidebar_container"></div>
        <div id="content">
          <h1 align="center">編輯『<?php echo $row_rs_album['aName']; ?>』相簿類別 <a href="addtype.php?aId=<?php echo $row_rs_album['aId']; ?>">(新增類別)</a></h1>
          <div id="primarycontent">
          <!-- primary content start -->
          <blockquote>
          <!-- 網站內容縮排設定 -->
        
            <?php do { ?>
            <div class="post">
            
              <div class="header">   <?php if ($totalRows_rs_type == 0) { // Show if recordset empty ?>尚未新增類別<br><br>  <?php } // Show if recordset empty ?>
                     <?php if ($totalRows_rs_type != 0) { // Show if recordset empty ?>
                     
                <div class="sf-arrow"><span style="font-size: 30px"><a href="edittype.php?tId=<?php echo $row_rs_type['tId']; ?>">-----<?php echo $row_rs_type['tName']; ?></a></span><span class="date"><span style="font-size: 18px; font-weight: bold;"><a href="del_type.php?tId=<?php echo $row_rs_type['tId']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪除此相簿嗎?內容將被全數刪除');return document.MM_returnValue"> [刪除]</a></span></span></div>
                
               
             
                <div>
                  <div align="right">
             
                      最後編輯時間
 
：<span class="date"><?php echo $row_rs_type['tTime2']; ?></span></div>
                </div>
                  <?php } // Show if recordset empty ?>
                <div class="date"></div>
              </div>
              <div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_type = mysqli_fetch_assoc($rs_type)); ?>
          </div>
          <p><a href="album.php">回相簿管理</a></p>
          <p><a href="index.php">回管理首頁</a></p>
          <div>
            <div align="right">
              <?php 
//分頁的變數設定以及分頁函式呼叫
$prev_rs_album = "« 較新的訊息";
$next_rs_album = "較舊的訊息»";
$separator = " | ";
$max_links = 10;
$pages_navigation_rs_album = buildNavigation($pageNum_rs_album,$totalPages_rs_album,$prev_rs_album,$next_rs_album,$separator,$max_links,true); 

print $pages_navigation_rs_album[0]; 
?>
          <?php print $pages_navigation_rs_album[1]; ?> <?php print $pages_navigation_rs_album[2]; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div> <div id="down"></div><!-- 網站下方校狗圖案版面 -->
  <!-- JavaScript函式載入 -->

</body>
</html>
<?php
mysqli_free_result($rs_album);

mysqli_free_result($rs_type);
?>
