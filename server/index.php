<?php

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
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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


$query_rs_new = "SELECT * FROM post ORDER BY pIndex DESC";
$rs_new = mysqli_query($gra2017, $query_rs_new);
$row_rs_new = mysqli_fetch_assoc($rs_new);
$totalRows_rs_new = mysqli_num_rows($rs_new);
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
        <div id="content">
          <h1 align="center">歡迎來到內容管理 </h1>
          <p align="center"></p>
          <div>
            <div align="right"></div>
            <center>
              <a href="editpost.php">最新消息編輯</a>
            </center><br>
                      <center>
              <a href="editabout.php">編輯關於</a>
            </center><br>
                      <center>
              <a href="editaboutus.php">編輯關於我們</a>
            </center>
            <br>
                      <center>
              <a href="editteabless.php">管理老師祝福</a>
            ----進入<a href="../blessed.php">老師祝福</a>
            </center> <br>
                      <center>
              <a href="album.php">管理相簿</a>
            ----進入<a href="../album.php">相簿頁面</a>
                      </center>
            <br>
                      <center>
              <a href="photo.php">管理照片</a>
            </center>
            
                      <div align="right"><br>
                        <a href="<?php echo $logoutAction ?>">登出管理帳號</a><br>
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
mysqli_free_result($rs_new);
?>
