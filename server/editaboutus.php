<?php require_once('../Connections/gra2017.php'); ?>
<?php require_once('../Connections/gra2017.php'); ?>
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

<?php require_once('../Connections/gra2017.php'); ?>


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
  $updateSQL = sprintf("UPDATE aboutus SET main1=%s, main2=%s, theme=%s, `time`=%s, place=%s, tel1=%s, tel2=%s WHERE id=%s",
                       GetSQLValueString($gra2017, $_POST['textfield'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield2'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield3'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield4'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield5'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield6'], "text"),
                       GetSQLValueString($gra2017, $_POST['textfield7'], "text"),
                       GetSQLValueString(1, "int"));

  
  $Result1 = mysqli_query($gra2017, $updateSQL);

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




$query_rs_editus = "SELECT * FROM aboutus WHERE id = 1";
$rs_editus = mysqli_query($gra2017, $query_rs_editus);
$row_rs_editus = mysqli_fetch_assoc($rs_editus);
$totalRows_rs_editus = mysqli_num_rows($rs_editus);
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>編輯消息</title>
  

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
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="center">主辦單位
                    <input name="textfield" type="text" id="textfield" value="<?php echo $row_rs_editus['main1']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center">
                    <input name="textfield2" type="text" id="textfield2" value="<?php echo $row_rs_editus['main2']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center">典禮主題
                    <input name="textfield3" type="text" id="textfield3" value="<?php echo $row_rs_editus['theme']; ?>" size="30">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center">典禮時間
                    <input name="textfield4" type="text" id="textfield4" value="<?php echo $row_rs_editus['time']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center">典禮地點
                    <input name="textfield5" type="text" id="textfield5" value="<?php echo $row_rs_editus['place']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><div align="center">聯絡電話
                    <input name="textfield6" type="text" id="textfield6" value="<?php echo $row_rs_editus['tel1']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center">
                    <input name="textfield7" type="text" id="textfield7" value="<?php echo $row_rs_editus['tel2']; ?>" size="50">
                  </div></td>
                </tr>
                <tr>
                  <td><div align="center"></div></td>
                </tr>
                <tr>
                  <td><br><br></td>
                </tr>
                <tr>
                  <td align="left" valign="middle"><a href="index.php">回管理首頁</a></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">      <div align="right">
                  
                    <span style="font-size: 1.8em; font-style: normal; font-weight: bolder;">
                      <input type="hidden" name="MM_insert" value="form1" />
                    </span>
                    
                      <input type ="submit" name="button" id="button" value="編輯" class="search-submit" style="width:150px;height:60px;font-size:28px;border-radius:4px;" onclick="window.onbeforeunload=null;return true;">
                      <input type="hidden" value="<?php echo $row_rs_editus['pFilename']; ?>">
                   
                  </div></td>
                </tr>
              </table>
              <input type="hidden" name="MM_update" value="form1">
              <input type="hidden" name="MM_update" value="form1">
              </form></td>
        </table>
        <div align="center"><p>&nbsp;</p></div>
        
         </blockquote>
      </div>
    </div>
  </div> <div id="down"></div><!-- 網站下方校狗圖案版面 -->

</body>
</html>
<?php
mysqli_free_result($rs_editus);

mysqli_free_result($rs_editus);
?>
