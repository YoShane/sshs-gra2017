
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

include('resize.php');

if (phpversion() > "4.0.6") {
	$HTTP_POST_FILES = &$_FILES;
}
define("MAX_SIZE",52428800);
define("DESTINATION_FOLDER", "./Picture");
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
				$destW = 372;
				$destH = 474;
				imagesResize($src,$dest,$destW,$destH);
			
                 @unlink('./Picture/' . $_POST['Filename']);	
			} else {
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
			case 4 : $_name_= $_POST['Filename'];
		}}
		
	if($errStr != ""){
		header ('Content-type: text/html; charset=utf-8');
		echo "<script>javascript:alert(\"錯誤! " . $errStr . "\");</script>";
		echo "<script>parent.location=\"editnew.php\"</script>";
		exit;	
	}	
	
}
?>
<?php
if (!function_exists("GetSQLValueString")) { //Dreamweaver內建Function，判斷PHP的版本去進行丟值的動作

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
	
  $updateSQL = sprintf("UPDATE post SET pTitle=%s, pContent=%s, pFilename=%s, pOutline=%s, pYoutube=%s WHERE pIndex=%s",
                       GetSQLValueString($gra2017, $_POST['pTitle'], "text"),
                       GetSQLValueString($gra2017, $_POST['pContent'], "text"),
					   GetSQLValueString($gra2017, $_name_, "text"),
					   GetSQLValueString(nl2br($_POST['pOutline']), "text"),
					   GetSQLValueString($gra2017, $_POST['pYoutube'], "text"),
                       GetSQLValueString($gra2017, $_GET['pIndex'], "int"));

  
  $Result1 = mysqli_query($gra2017, $updateSQL);

  $updateGoTo = "editpost.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


$colname_rs_editnew = "-1";
if (isset($_GET['pIndex'])) {
  $colname_rs_editnew = $_GET['pIndex'];
}

$query_rs_editnew = sprintf("SELECT * FROM post WHERE pIndex = %s", GetSQLValueString($gra2017, $colname_rs_editnew, "int"));
$rs_editnew = mysqli_query($gra2017, $query_rs_editnew);
$row_rs_editnew = mysqli_fetch_assoc($rs_editnew);
$totalRows_rs_editnew = mysqli_num_rows($rs_editnew);
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
                  <td>
                     <strong><span style="font-size: 30px">訊息標題：</span></strong>                 
                      <label>
                        <input name="pTitle" type="text" autofocus required id="pTitle" style="font-size:28px;width:500px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_editnew['pTitle']; ?>" size="30" maxlength="22"/> 
                        <span style="font-size: 30px">(最多20字)</span>
                      </label>
                  </p>     </td>
                </tr>
                <tr>
                  <td><br><label for="textfield">內容簡要</label>
                    <label for="pOutline">:</label>
                    <textarea name="pOutline" cols="40" rows="4" id="pOutline"><?php echo br2nl($row_rs_editnew['pOutline']); ?></textarea><br><br></td>
                </tr>
                <tr>
                  <td><textarea name="pContent" required id="pContent" onClick="check();"><?php echo $row_rs_editnew['pContent']; ?></textarea></td>
                  <script>
				  CKEDITOR.replace('pContent',
				  {
					 						filebrowserBrowseUrl: '../../ck/ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl: '../../ck/ckfinder/ckfinder.html?type=Images',
						filebrowserFlashBrowseUrl: '../../ck/ckfinder/ckfinder.html?type=Flash',
						filebrowserUploadUrl: '../../ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserImageUploadUrl: '../../ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
						filebrowserFlashUploadUrl: '../../ck/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
					});
					window.onbeforeunload=function(){
		return '系統可能不會儲存您所做的變更。';
}
				  </script>
                </tr>
                <tr>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="middle"><label for="pYoutube">Youtube網址(非影片模式，此處留空)</label>
                    https://www.youtube.com/embed/
                    <input name="pYoutube" type="text" id="pYoutube" value="<?php echo $row_rs_editnew['pYoutube']; ?>" size="100"></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">上傳圖片<input name="fileField" type="file" id="fileField" onClick="check();" style="height:30px;width:250px;"></font>              支援格式:</span>PNG.JPEG.GIF(50MB以下)    
              
              <p><font color="#ff0000">※不支援中文檔名(請用英文或數字)。</font>          
              <p> ※大小目前鎖定為最大372*474，可上傳相近比例的圖片，本系統會自動調整。               
              <p>※照片不須額外命名。</td>
                </tr>
                <tr>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="middle">      <div align="right">
                  
                    <span style="font-size: 1.8em; font-style: normal; font-weight: bolder;">
                      <input type="hidden" name="MM_insert" value="form1" />
                    </span>
                    
                      <input type ="submit" name="button" id="button" value="編輯" class="search-submit" style="width:150px;height:60px;font-size:28px;border-radius:4px;" onclick="window.onbeforeunload=null;return true;">
                      <input name="Filename" type="hidden" id="Filename" value="<?php echo $row_rs_editnew['pFilename']; ?>">
                   
                  </div></td>
                </tr>
              </table>
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
mysqli_free_result($rs_editnew);
?>
