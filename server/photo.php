<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
                GLOBAL $maxRows_rs_photo,$totalRows_rs_photo;
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
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_rs_photo") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_photo=$precedente$_get_vars\">$prev_Recordset1</a>" :  "$prev_Recordset1";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_rs_photo) + 1;
					$max_l = ($a*$maxRows_rs_photo >= $totalRows_rs_photo) ? $totalRows_rs_photo : ($a*$maxRows_rs_photo);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_photo=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_rs_photo=$successivo$_get_vars\">$next_Recordset1</a>" : "$next_Recordset1";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}


function TrimByLength2($str, $len, $word) { //割取字串Function(防止文字輸入過多)
  $end = "";
  if (mb_strlen($str,"utf-8") > $len) $end = "...";
  $str = mb_substr($str, 0, $len,"UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
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
$rs_album = mysqli_query($gra2017, $query_rs_album);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = mysqli_num_rows($rs_album);

$maxRows_rs_photo = 15;
$pageNum_rs_photo = 0;
if (isset($_GET['pageNum_rs_photo'])) {
  $pageNum_rs_photo = $_GET['pageNum_rs_photo'];
}
$startRow_rs_photo = $pageNum_rs_photo * $maxRows_rs_photo;

$colname_rs_photo = "-1";
if (isset($_GET['aId'])) {
  $colname_rs_photo = $_GET['aId'];
}

$query_rs_photo = sprintf("SELECT * FROM photo WHERE pLalbum = %s ORDER BY pType DESC,pId ASC", GetSQLValueString($gra2017, $colname_rs_photo, "int"));
$query_limit_rs_photo = sprintf("%s LIMIT %d, %d", $query_rs_photo, $startRow_rs_photo, $maxRows_rs_photo);
$rs_photo = mysqli_query($gra2017, $query_limit_rs_photo);
$row_rs_photo = mysqli_fetch_assoc($rs_photo);

if (isset($_GET['totalRows_rs_photo'])) {
  $totalRows_rs_photo = $_GET['totalRows_rs_photo'];
} else {
  $all_rs_photo = mysqli_query($gra2017, $query_rs_photo);
  $totalRows_rs_photo = mysqli_num_rows($all_rs_photo);
}
$totalPages_rs_photo = ceil($totalRows_rs_photo/$maxRows_rs_photo)-1;


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
          <form action="photo.php" method="get" name="form1" id="form1">
          
          <h1 align="center">管理照片
            <select name="aId" id="aId" style="font-size:28px;width:300px;font-family:Microsoft JhengHei;" onchange="form1.submit();">
              <option value="0" <?php if (!(strcmp(0, $_GET['aId']))) {echo "selected=\"selected\"";} ?>>---選取相簿----</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rs_album['aId']?>"<?php if (!(strcmp($row_rs_album['aId'], $_GET['aId']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_album['aName']?></option>
              <?php
} while ($row_rs_album = mysqli_fetch_assoc($rs_album));
  $rows = mysqli_num_rows($rs_album);
  if($rows > 0) {
      mysql_data_seek($rs_album, 0);
	  $row_rs_album = mysqli_fetch_assoc($rs_album);
  }
?>
            </select>

            <?php if ($_GET['aId'] != 0) { // Show if recordset not empty ?>
<a href="addphoto.php?aId=<?php echo $_GET['aId']?>&page=<?php echo $_GET['pageNum_rs_photo']?>">(新增照片)</a><?php } ?></h1>

</form>
          <div id="primarycontent">
          <!-- primary content start -->
          <blockquote>
          <!-- 網站內容縮排設定 -->
        
            <?php do { ?>
            <div class="post">
            <?php if (($totalRows_rs_photo == 0) and ($_GET['aId'] != 0)) { // Show if recordset not empty ?>未新增照片<br><br>
            
            <?php } ?>
              <?php if ($totalRows_rs_photo > 0) { // Show if recordset not empty ?>
              
              <?php            
            $colname_rs_findtype = "-1";
if (isset($row_rs_photo['pType'])) {
  $colname_rs_findtype = $row_rs_photo['pType'];
}

$query_rs_findtype = sprintf("SELECT * FROM type WHERE tId = %s", GetSQLValueString($gra2017, $colname_rs_findtype, "int"));
$rs_findtype = mysqli_query($gra2017, $query_rs_findtype);
$row_rs_findtype = mysqli_fetch_assoc($rs_findtype);
$totalRows_rs_findtype = mysqli_num_rows($rs_findtype);

?>

  <div class="header">
    <div class="sf-arrow"><span style="font-size: 30px"><a href="editphoto.php?pId=<?php echo $row_rs_photo['pId']; ?>&page=<?php echo $_GET['pageNum_rs_photo']; ?>"><img src="Picture/photo/thumb/<?php echo $row_rs_photo['pFilename']; ?>" alt="" width="200"/></a></span><span class="date"><span style="font-size: 18px; font-weight: bold;">
      [---><?php echo $row_rs_findtype['tName']; ?>]<font color="#1F4AA2"><?php echo $row_rs_photo['pName']; ?></font>
      <a href="del_photo.php?pId=<?php echo $row_rs_photo['pId']; ?>&page=<?php echo $_GET['pageNum_rs_photo']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪嗎?');return document.MM_returnValue"> [刪除]</a></span></span></div>
    <div>
      <div align="right">最後編輯時間：<span class="date"><?php echo $row_rs_album['aTime2']; ?></span></div>
      </div>
    <div class="date"></div>
  </div>
  <hr>
  <?php } // Show if recordset not empty ?>
<div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_photo = mysqli_fetch_assoc($rs_photo)); ?>
          </div>
          <p><a href="index.php">回管理首頁</a></p>
          <div>
            <div align="right">
              <?php 
# variable declaration
$prev_rs_photo = "« 上一頁";
$next_rs_photo = "下一頁 »";
$separator = " | ";
$max_links = 10;
$pages_navigation_rs_photo = buildNavigation($pageNum_rs_photo,$totalPages_rs_photo,$prev_rs_photo,$next_rs_photo,$separator,$max_links,true); 

print $pages_navigation_rs_photo[0]; 
?>
              <?php print $pages_navigation_rs_photo[1]; ?> <?php print $pages_navigation_rs_photo[2]; ?>
              
            </div>
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

mysqli_free_result($rs_photo);

mysqli_free_result($rs_findtype);
?>
