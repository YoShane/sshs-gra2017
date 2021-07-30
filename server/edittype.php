
<?php require_once('../Connections/gra2017.php'); ?>
<?php
function br2nl($text){
    return preg_replace('/<br\\s*?\/??>/i','',$text);
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
  $updateSQL = sprintf("UPDATE type SET tName=%s WHERE tId=%s",
                       GetSQLValueString($gra2017, $_POST['tName'], "text"),					
                       GetSQLValueString($gra2017, $_GET['tId'], "int"));

  
  $Result1 = mysqli_query($gra2017, $updateSQL);

  $updateGoTo = "type.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= "aId=" . $_POST['go'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


$colname_rs_type = "-1";
if (isset($_GET['tId'])) {
  $colname_rs_type = $_GET['tId'];
}

$query_rs_type = sprintf("SELECT * FROM type WHERE tId = %s", GetSQLValueString($gra2017, $colname_rs_type, "int"));
$rs_type = mysqli_query($gra2017, $query_rs_type);
$row_rs_type = mysqli_fetch_assoc($rs_type);
$totalRows_rs_type = mysqli_num_rows($rs_type);

$colname_rs_findalbum = "-1";
if (isset($row_rs_type['tLalbum'])) {
  $colname_rs_findalbum = $row_rs_type['tLalbum'];
}

$query_rs_findalbum = sprintf("SELECT aName FROM album WHERE aId = %s", GetSQLValueString($gra2017, $colname_rs_findalbum, "int"));
$rs_findalbum = mysqli_query($gra2017, $query_rs_findalbum);
$row_rs_findalbum = mysqli_fetch_assoc($rs_findalbum);
$totalRows_rs_findalbum = mysqli_num_rows($rs_findalbum);
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>編輯類別</title>
  

  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="../../css/style.css" />
   <script type="text/javascript" src="../../js/modernizr-1.5.min.js"></script>
    <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>


<script>
function check() {
window.onbeforeunload=function(){
		return '系統可能不會儲存您所做的變更。';
}}
</script>
  <script src="../../ck/ckeditor/ckeditor.js"></script>
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
<div id="top"></div> <!-- top雲朵版面 -->
  <div id="container">
    
    <div id="main">
      <div id="site_content">
      <blockquote><!-- 網站內容縮排設定 -->
      <br>
      <br>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <td>
              <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><strong><span style="font-size: 30px">相簿名稱：<?php echo $row_rs_findalbum['aName']; ?></span></strong></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><span style="font-size: 30px">類別名稱：</span></strong>
                    <label>
                      <input name="tName" type="text" autofocus required id="tName" style="font-size:28px;width:200px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_type['tName']; ?>" size="30" maxlength="22"/>
                    </label></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">      <div align="right">
                    
                    <span style="font-size: 1.8em; font-style: normal; font-weight: bolder;">
                      <input type="hidden" name="MM_insert" value="form1" />
                      </span>
                    
                    <input type ="submit" name="button" id="button" value="編輯" class="search-submit" style="width:150px;height:60px;font-size:28px;border-radius:4px;" onclick="window.onbeforeunload=null;return true;">
                    <input name="go" type="hidden" id="hiddenField" value="<?php echo $row_rs_type['tLalbum']; ?>">
                    
                    </div></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              </form></td>
        </table>
         <div align="center"><p><p><a href="type.php?aId=<?php echo $row_rs_type['tLalbum']; ?>">回類別管理</a></p>&nbsp;</p></div>
         </blockquote>
      </div>
    </div>
  </div> <div id="down"></div><!-- 網站下方校狗圖案版面 -->

</body>
</html>
<?php
mysqli_free_result($rs_findalbum);

mysqli_free_result($rs_type);
?>
