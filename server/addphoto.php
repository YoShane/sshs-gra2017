
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
include('resize.php');
//	---------------------------------------------
//	Pure PHP Upload version 1.1
//	-------------------------------------------
if (phpversion() > "4.0.6") {
	$HTTP_POST_FILES = &$_FILES;
}
define("MAX_SIZE",52428800);
define("DESTINATION_FOLDER", "./Picture/photo");
define("no_error", "");
define("yes_error", "");
$_accepted_extensions_ = "png,gif,jpg";
if(strlen($_accepted_extensions_) > 0){
	$_accepted_extensions_ = @explode(",",$_accepted_extensions_);
} else {
	$_accepted_extensions_ = array();
}
/*	modify */
if(!empty($HTTP_POST_FILES['fileField'])){
	if(is_uploaded_file($HTTP_POST_FILES['fileField']['tmp_name']) && $HTTP_POST_FILES['fileField']['error'] == 0){
		$_file_ = $HTTP_POST_FILES['fileField'];
		$errStr = "";
		$_name_ = $_file_['name'];
		$_type_ = $_file_['type'];
		$_tmp_name_ = $_file_['tmp_name'];
		$_size_ = $_file_['size'];
		
						if($_size_ > MAX_SIZE && MAX_SIZE > 0){
			$errStr = "檔案大小超過限制";
		}
		$_ext_ = explode(".", $_name_);
		$_ext_ = strtolower($_ext_[count($_ext_)-1]);
		if(!in_array($_ext_, $_accepted_extensions_) && count($_accepted_extensions_) > 0){
			$errStr = "不接受的檔案格式";
		}
		if(!is_dir(DESTINATION_FOLDER) && is_writeable(DESTINATION_FOLDER)){
			$errStr = "指定位置非目錄";
		}
		if(empty($errStr)){
			$_name_ = date("YmdHis") . "." . $_ext_;
			if(@move_uploaded_file($_tmp_name_,DESTINATION_FOLDER . "/" . $_name_)){
				//header("Location: " . no_error);
				//縮圖
				$src  = DESTINATION_FOLDER . "/" . $_name_;
				$dest = $src;
				$destW = 640;
				$destH = 512;
				imagesResize($src,$dest,$destW,$destH);
				
				$src  = DESTINATION_FOLDER . "/" . $_name_;
				$dest = DESTINATION_FOLDER . "/thumb/" . $_name_;

				$destW = 320;
				$destH = 256;
				imagesResize($src,$dest,$destW,$destH);
			
	
			} else {
				$errStr = "複製檔案至目的位置失敗";
				//header("Location: " . yes_error);
			}
		} else {
			//header("Location: " . yes_error);
		}
	}
	else{
		switch($_FILES['fileField']['error']){
			case 1 : $errStr = "檔案大小超出 php.ini:upload_max_filesize 限制";
			case 2 : $errStr = "檔案大小超出 MAX_FILE_SIZE 限制";
			case 3 : $errStr = "檔案僅被部分上傳";
			case 4 : $errStr = "檔案未上傳成功";
		}
	}
	
	if($errStr != ""){
		header ('Content-type: text/html; charset=utf-8');
		echo "<script>javascript:alert(\"錯誤! " . $errStr . "\");</script>";
		echo "<script>parent.location=\"index.php\"</script>";
		exit;	
	}		
	
	
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

$colname_rs_album = "-1";
if (isset($_GET['aId'])) {
  $colname_rs_album = $_GET['aId'];
}

$query_rs_album = sprintf("SELECT * FROM album WHERE aId = %s", GetSQLValueString($gra2017, $colname_rs_album, "int"));
$rs_album = mysqli_query($gra2017, $query_rs_album);
$row_rs_album = mysqli_fetch_assoc($rs_album);
$totalRows_rs_album = mysqli_num_rows($rs_album);

$colname_rs_type = "-1";
if (isset($_GET['aId'])) {
  $colname_rs_type = $_GET['aId'];
}

$query_rs_type = sprintf("SELECT * FROM type WHERE tLalbum = %s", GetSQLValueString($gra2017, $colname_rs_type, "int"));
$rs_type = mysqli_query($gra2017, $query_rs_type);
$row_rs_type = mysqli_fetch_assoc($rs_type);
$totalRows_rs_type = mysqli_num_rows($rs_type);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	if ($errStr == "") {
	
  $insertSQL = sprintf("INSERT INTO photo (pLalbum, pFilename, pType, pName) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($gra2017, $_POST['go'], "text"),
					   GetSQLValueString($gra2017, $_name_, "text"),
                       GetSQLValueString($gra2017, $_POST['pType'], "int"),
					   GetSQLValueString($gra2017, $_POST['pName'], "text"));

  
  $Result1 = mysqli_query($gra2017, $insertSQL);

  $insertGoTo = "photo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= "aId=" . $_POST['go'] . "&pageNum_rs_photo=" . $_GET['page'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>新增照片</title>
  

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
                  <td>
                    <strong><span style="font-size: 30px">相簿：<?php echo $row_rs_album['aName']; ?>
                    <input name="go" type="hidden" id="go" value="<?php echo $row_rs_type['tLalbum']; ?>">
                    </span></strong></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>類別：
                    <select name="pType" id="pType" style="font-size:28px;width:300px;font-family:Microsoft JhengHei;" >
                      <option value="0" <?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>>---選取類別----</option>
                      <?php
do {  
?>
<option value="<?php echo $row_rs_type['tId']?>"<?php if (!(strcmp($row_rs_type['tId'], 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_type['tName']?></option>
                      <?php
} while ($row_rs_type = mysqli_fetch_assoc($rs_type));
  $rows = mysqli_num_rows($rs_type);
  if($rows > 0) {
      mysql_data_seek($rs_type, 0);
	  $row_rs_type = mysqli_fetch_assoc($rs_type);
  }
?>
                    </select>
                      
                      <?php
do {  
?>
                      <option value="<?php echo $row_rs_album['aId']?>"<?php if (!(strcmp($row_rs_album['aId'], $_GET['aId']))) {echo "selected=\"selected\"";} ?>></option>
                      <?php
} while ($row_rs_album = mysqli_fetch_assoc($rs_album));
  $rows = mysqli_num_rows($rs_album);
  if($rows > 0) {
      mysql_data_seek($rs_album, 0);
	  $row_rs_album = mysqli_fetch_assoc($rs_album);
  }
?>
                    </select></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="middle">名稱(選填、建議設定)：
                    <input name="pName" type="text" id="pName" style="font-size:28px;width:250px;font-family:Microsoft JhengHei;" maxlength="50"></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><font ="+4">上傳圖片<input name="fileField" type="file" required id="fileField" onClick="check();" style="height:30px;width:250px;"></font>              支援格式:</span>PNG.JPEG.GIF(50MB以下)    
                    
                    <p><font color="#ff0000">※不支援中文檔名(請用英文或數字)。</font>          
                      <p> ※大小目前鎖定為最大640*512，可上傳相近比例的圖片，本系統會自動調整。               
                    <p>※照片不須額外命名。</td>
                </tr>
                <tr>
                  <td align="right" valign="middle">      <div align="right">
                  
                    <span style="font-size: 1.8em; font-style: normal; font-weight: bolder;">
                      <input type="hidden" name="MM_insert" value="form1" />
                    </span>
                    
                      <input type ="submit" name="button" id="button" value="新增" class="search-submit" style="width:150px;height:60px;font-size:28px;border-radius:4px;" onclick="window.onbeforeunload=null;return true;">
                   
                  </div></td>
                </tr>
              </table>
              </form></td>
        </table>
        <div align="center">
          <p><a href="photo.php?aId=<?php echo $row_rs_type['tLalbum']; ?>">上一頁</a></p></div>
        
         </blockquote>
      </div>
    </div>
  </div> <div id="down"></div><!-- 網站下方校狗圖案版面 -->

</body>
</html>
<?php
mysqli_free_result($rs_album);

mysqli_free_result($rs_type);
?>
