<?php
error_reporting(0);
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_gra2017 = "kfgk8u2ogtoylkq9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$database_gra2017 = "rbjgl4swwiry8chu";
$username_gra2017 = "your account";
$password_gra2017 = "your password";


$gra2017 = new mysqli($hostname_gra2017, $username_gra2017, $password_gra2017, $database_gra2017);
if ($gra2017->connect_error) {
    die('無法連上資料庫：' . $gra2017->connect_error);
}
$gra2017->set_charset("utf8");
?>