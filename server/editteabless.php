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


$query_rs_bless0 = "SELECT * FROM bless WHERE bLevel = 0 ORDER BY bOrder ASC";
$rs_bless0 = mysqli_query($gra2017,$query_rs_bless0);
$row_rs_bless0 = mysqli_fetch_assoc($rs_bless0);
$totalRows_rs_bless0 = mysqli_num_rows($rs_bless0);


$query_rs_bless1 = "SELECT * FROM bless WHERE bLevel = 1 ORDER BY bOrder ASC";
$rs_bless1 = mysqli_query($gra2017,$query_rs_bless1);
$row_rs_bless1 = mysqli_fetch_assoc($rs_bless1);
$totalRows_rs_bless1 = mysqli_num_rows($rs_bless1);


$query_rs_bless2 = "SELECT * FROM bless WHERE bLevel = 2 ORDER BY bOrder ASC";
$rs_bless2 = mysqli_query($gra2017, $query_rs_bless2);
$row_rs_bless2 = mysqli_fetch_assoc($rs_bless2);
$totalRows_rs_bless2 = mysqli_num_rows($rs_bless2);


$query_rs_bless3 = "SELECT * FROM bless WHERE bLevel = 3 ORDER BY bOrder ASC";
$rs_bless3 = mysqli_query($gra2017, $query_rs_bless3);
$row_rs_bless3 = mysqli_fetch_assoc($rs_bless3);
$totalRows_rs_bless3 = mysqli_num_rows($rs_bless3);
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
          <h1 align="center">師長祝福管理 <a href="addbless.php">(點此新增老師祝福)</a></h1>
          <div id="primarycontent">
          <!-- primary content start -->
          <blockquote>
          <!-- 網站內容縮排設定 -->
        <font size="+3">非導師編輯區</font><br><br>
            <?php do { ?>
            <div class="post">
            
              <div class="header">
                <div class="sf-arrow"><span style="font-size: 30px"><a href="editbless.php?bId=<?php echo $row_rs_bless0['bId']; ?>">-----<?php echo $row_rs_bless0['bName']; ?></a></span><span class="date"><span style="font-size: 18px; font-weight: bold;"><a href="del_bless.php?bId=<?php echo $row_rs_bless0['bId']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪除此訊息嗎?');return document.MM_returnValue"> [刪除]</a></span></span></div>
                <div>
                  <div align="right">最後編輯時間：<span class="date"><?php echo $row_rs_bless0['bTime2']; ?></span></div>
                </div>
                <div class="date"></div>
              </div>
              <div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_bless0 = mysqli_fetch_assoc($rs_bless0)); ?>
            
            <br>
              <font size="+3">國中導師編輯區</font><br><br>
            <?php do { ?>
            <div class="post">
            
              <div class="header">
                <div class="sf-arrow"><span style="font-size: 30px"><a href="editbless.php?bId=<?php echo $row_rs_bless1['bId']; ?>">-----<?php echo $row_rs_bless1['bClass']; ?>[<?php echo $row_rs_bless1['bName']; ?>老師]</a></span><span class="date"><span style="font-size: 18px; font-weight: bold;"><a href="del_bless.php?bId=<?php echo $row_rs_bless1['bId']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪除此訊息嗎?');return document.MM_returnValue"> [刪除]</a></span></span></div>
                <div>
                  <div align="right">最後編輯時間：<span class="date"><?php echo $row_rs_bless1['bTime2']; ?></span></div>
                </div>
                <div class="date"></div>
              </div>
              <div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_bless1 = mysqli_fetch_assoc($rs_bless1)); ?>
            
             <br>
              <font size="+3">高中導師編輯區</font><br><br>
            <?php do { ?>
            <div class="post">
            
              <div class="header">
                <div class="sf-arrow"><span style="font-size: 30px"><a href="editbless.php?bId=<?php echo $row_rs_bless2['bId']; ?>">-----<?php echo $row_rs_bless2['bClass']; ?>[<?php echo $row_rs_bless2['bName']; ?>老師]</a></span><span class="date"><span style="font-size: 18px; font-weight: bold;"><a href="del_bless.php?bId=<?php echo $row_rs_bless2['bId']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪除此訊息嗎?');return document.MM_returnValue"> [刪除]</a></span></span></div>
                <div>
                  <div align="right">最後編輯時間：<span class="date"><?php echo $row_rs_bless2['bTime2']; ?></span></div>
                </div>
                <div class="date"></div>
              </div>
              <div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_bless2 = mysqli_fetch_assoc($rs_bless2)); ?>
             <br>
              <font size="+3">科任其他編輯區</font><br><br>
            <?php do { ?>
            <div class="post">
            
              <div class="header">
                <div class="sf-arrow"><span style="font-size: 30px"><a href="editbless.php?bId=<?php echo $row_rs_bless3['bId']; ?>">-----<?php echo $row_rs_bless3['bClass']; ?>[<?php echo $row_rs_bless3['bName']; ?>老師]</a></span><span class="date"><span style="font-size: 18px; font-weight: bold;"><a href="del_bless.php?bId=<?php echo $row_rs_bless3['bId']; ?>" onClick="window.onbeforeunload=null;return true;tfm_confirmLink('請問您確定要刪除此訊息嗎?');return document.MM_returnValue"> [刪除]</a></span></span></div>
                <div>
                  <div align="right">最後編輯時間：<span class="date"><?php echo $row_rs_bless3['bTime2']; ?></span></div>
                </div>
                <div class="date"></div>
              </div>
              <div class="footer">
                <div class="footer"> </div>
              </div>
            </div>
            <?php } while ($row_rs_bless3 = mysqli_fetch_assoc($rs_bless3)); ?>
            
          </div>
          <p><a href="index.php">回管理首頁</a></p>
          <div>
            <div align="right">
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
mysqli_free_result($rs_bless0);

mysqli_free_result($rs_bless1);

mysqli_free_result($rs_bless2);

mysqli_free_result($rs_bless3);
?>
