<?php
set_time_limit(0);
error_reporting(0);
ini_set("display_errors",0);
try {
 $db = new PDO("mysql:host=localhost;dbname=dbadi", "kullaniciadi", "sifre",array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )));
} catch ( PDOException $e ){
 print $e->getMessage();
}
$limit = 10;
$sitedomain = "zulfumehmet.tk";
?>