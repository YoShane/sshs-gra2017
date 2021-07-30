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
include('resize.php');
//	---------------------------------------------
//	Pure PHP Upload version 1.1-1
//	-------------------------------------------
if (phpversion() > "4.0.6") {
	$HTTP_POST_FILES = &$_FILES;
}
define("MAX_SIZE",52428800);
$DESTINATION_FOLDER = "./Picture/teaimg";
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
		if(!is_dir($DESTINATION_FOLDER) && is_writeable($DESTINATION_FOLDER)){
			$errStr = "指定位置非目錄";
		}
		if(empty($errStr)){
			$_name_ = date("YmdHis") . "." . $_ext_;
			if(@move_uploaded_file($_tmp_name_,$DESTINATION_FOLDER . "/" . $_name_)){
				//header("Location: " . no_error);
				
				$src  = $DESTINATION_FOLDER . "/" . $_name_;
				$dest = $src;
				$destW = 740;
				$destH = 514;
				imagesResize($src,$dest,$destW,$destH);
			
	@unlink('./Picture/teaimg/' . $_POST['Filename']);
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
			case 4 : $_name_= $_POST['Filename'];
		}
	}
	
	if($errStr != ""){
		header ('Content-type: text/html; charset=utf-8');
		echo "<script>javascript:alert(\"錯誤! " . $errStr . "\");</script>";
		echo "<script>parent.location=\"addbless.php\"</script>";
		exit;	
	}		
}


//	---------------------------------------------
//	Pure PHP Upload version 1.1-2掃描上傳
//	-------------------------------------------

/*	modify */
if(!empty($HTTP_POST_FILES['fileField2'])){
	$DESTINATION_FOLDER = "./Picture/teawrit";
	if(is_uploaded_file($HTTP_POST_FILES['fileField2']['tmp_name']) && $HTTP_POST_FILES['fileField2']['error'] == 0){
		$_file_ = $HTTP_POST_FILES['fileField2'];
		$errStr = "";
		$_name2_ = $_file_['name'];
		$_type_ = $_file_['type'];
		$_tmp_name_ = $_file_['tmp_name'];
		$_size_ = $_file_['size'];
		
		if($_size_ > MAX_SIZE && MAX_SIZE > 0){
			$errStr = "檔案大小超過限制";
		}
		$_ext_ = explode(".", $_name2_);
		$_ext_ = strtolower($_ext_[count($_ext_)-1]);
		if(!in_array($_ext_, $_accepted_extensions_) && count($_accepted_extensions_) > 0){
			$errStr = "不接受的檔案格式";
		}
		if(!is_dir($DESTINATION_FOLDER) && is_writeable($DESTINATION_FOLDER)){
			$errStr = "指定位置非目錄";
		}
		if(empty($errStr)){
			$_name2_ = date("YmdHis") . "." . $_ext_;
			if(@move_uploaded_file($_tmp_name_,$DESTINATION_FOLDER . "/" . $_name2_)){
				//header("Location: " . no_error);
			
				$src  = $DESTINATION_FOLDER . "/" . $_name2_;
				$dest = $src;
				$destW = 1920;
				$destH = 768;
				imagesResize($src,$dest,$destW,$destH);
			
	  @unlink('./Picture/teawrit/' . $_POST['Filename']);
			} else {
				$errStr = "複製檔案至目的位置失敗";
				//header("Location: " . yes_error);
			}
		} else {
			//header("Location: " . yes_error);
		}
	}
	else{
		switch($_FILES['fileField2']['error']){
			case 1 : $errStr = "檔案大小超出 php.ini:upload_max_filesize 限制";
			case 2 : $errStr = "檔案大小超出 MAX_FILE_SIZE 限制";
			case 3 : $errStr = "檔案僅被部分上傳";
			case 4 : $_name2_= $_POST['Filename2'];
		}
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE bless SET bName=%s, bClass=%s, bFaceimg=%s, bBlessimg=%s, bText=%s, bLevel=%s, bFname=%s, bFb=%s, bOrder=%s WHERE bId=%s",
                       GetSQLValueString($gra2017, $_POST['bName'], "text"),
                       GetSQLValueString($gra2017, $_POST['bClass'], "text"),
                       GetSQLValueString($gra2017, $_name_, "text"),
                       GetSQLValueString($gra2017, $_name2_, "text"),
                       GetSQLValueString(nl2br($_POST['bText']), "text"),
                       GetSQLValueString($gra2017, $_POST['bLevel'], "int"),
                       GetSQLValueString($gra2017, $_POST['bFname'], "text"),
                       GetSQLValueString($gra2017, $_POST['bFb'], "text"),
                       GetSQLValueString($gra2017, $_POST['bOrder'], "int"),
                       GetSQLValueString($gra2017, $_GET['bId'], "int"));

  
  $Result1 = mysqli_query($gra2017, $updateSQL);

  $updateGoTo = "editteabless.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rs_edbless = "-1";
if (isset($_GET['bId'])) {
  $colname_rs_edbless = $_GET['bId'];
}

$query_rs_edbless = sprintf("SELECT * FROM bless WHERE bId = %s", GetSQLValueString($gra2017, $colname_rs_edbless, "int"));
$rs_edbless = mysqli_query($gra2017, $query_rs_edbless);
$row_rs_edbless = mysqli_fetch_assoc($rs_edbless);
$totalRows_rs_edbless = mysqli_num_rows($rs_edbless);
?>



<!DOCTYPE HTML>
<html>

<head>
  <title>編輯師長祝福</title>
  

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
                  <td><strong><span style="font-size: 30px">群組順序：</span></strong>
                    <label>
                      <input name="bOrder" type="text" autofocus required="required" id="bOrder" style="font-size:28px;width:50px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_edbless['bOrder']; ?>" size="6" maxlength="5"/>
                      <span style="font-size: 30px">(通常為班級尾碼)</span> </label>
                    </p></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>
                    <strong><span style="font-size: 30px">老師負責班級：</span></strong>                 
                    <label>
                      <input name="bClass" type="text" id="bClass" style="font-size:28px;width:150px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_edbless['bClass']; ?>" size="6" maxlength="25"/> 
                      <span style="font-size: 30px">(非班導此處留空)</span>
                      </label>
                    </p>     </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><span style="font-size: 30px">老師姓名：</span></strong>
                    <label>
                      <input name="bName" type="text"  required id="bName" style="font-size:28px;width:150px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_edbless['bName']; ?>" size="6" maxlength="15"/>
                    </label></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><span style="font-size: 30px">老師綽號：</span></strong>
                    <label>
                      <input name="bFname" type="text" id="bFname" style="font-size:28px;width:200px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_edbless['bFname']; ?>" size="6"/>
                    <span style="font-size: 30px">(選填，非班導不會顯示喔~)</span></label></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><span style="font-size: 30px">老師FB：</span></strong>
                    <label>
                      <input name="bFb" type="text" id="bFb"  style="font-size:28px;width:500px;font-family:Microsoft JhengHei;" onClick="check();" value="<?php echo $row_rs_edbless['bFb']; ?>" size="6"/>
                    <span style="font-size: 30px">(選填)</span></label></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><span style="font-size: 30px">Level：</span></strong>
                    <select name="bLevel" required id="bLevel" style="font-size:28px;width:150px;font-family:Microsoft JhengHei;">
                      <option value="2" <?php if (!(strcmp(2, $row_rs_edbless['bLevel']))) {echo "selected=\"selected\"";} ?>>高中班導</option>
                      <option value="1" <?php if (!(strcmp(1, $row_rs_edbless['bLevel']))) {echo "selected=\"selected\"";} ?>>國中班導</option>
                      <option value="0" <?php if (!(strcmp(0, $row_rs_edbless['bLevel']))) {echo "selected=\"selected\"";} ?>>重要人物</option>
<option value="3" <?php if (!(strcmp(3, $row_rs_edbless['bLevel']))) {echo "selected=\"selected\"";} ?>>科任或其他</option>
                    </select></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><label for="pYoutube" style="font-size: 30px">內容</label>
                    <label for="textarea">:</label>                    
                    <textarea name="bText" cols="50" rows="6" id="bText" style="font-size: 25px;font-family:Microsoft JhengHei;"><?php echo br2nl($row_rs_edbless['bText']); ?></textarea>
                    <br><br></td>
                </tr>
                <tr>
                  <td align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><font ="+4">上傳老師圖片
                      <input name="fileField" type="file" id="fileField" onClick="check();" style="height:30px;width:250px;">
                  </font> 支援格式:</span>PNG.JPEG.GIF(50MB以下)
                  <p><font color="#ff0000">※不支援中文檔名(請用英文或數字)。</font>
                  <p> ※大小目前鎖定為最大740*514，可上傳相近比例的圖片，本系統會自動調整。               
                  <p>※照片不須額外命名。</td>
                </tr>
                <tr>
                  <td align="left" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><font ="+4">上傳掃描圖片(非必要)
                      <input name="fileField2" type="file" id="fileField2" onClick="check();" style="height:30px;width:250px;"></font>              支援格式:</span>PNG.JPEG.GIF(50MB以下)    
              
              <p><font color="#ff0000">※不支援中文檔名(請用英文或數字)。</font>          
              <p> ※大小目前鎖定為最大1920*768，可上傳相近比例的圖片，本系統會自動調整。               
              <p>※照片不須額外命名。</td>
                </tr>
                <tr>
                  <td align="right" valign="middle">      <div align="right">
                  
                    <span style="font-size: 1.8em; font-style: normal; font-weight: bolder;">
                      <input type="hidden" name="MM_insert" value="form1" />
                    </span>
                    
                      <input type ="submit" name="button" id="button" value="編輯" class="search-submit" style="width:150px;height:60px;font-size:28px;border-radius:4px;" onclick="window.onbeforeunload=null;return true;">
                   
                  </div></td>
                </tr>
              </table><input name="Filename" type="hidden" id="Filename" value="<?php echo $row_rs_edbless['bFaceimg']; ?>">
              <input name="Filename2" type="hidden" id="Filename2" value="<?php echo $row_rs_edbless['bBlessimg']; ?>">
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
mysqli_free_result($rs_edbless);
?>
