<?php
echo $_SESSION["Shost"];
echo $_SESSION["Suser"];
echo $_SESSION["Spass"];
echo $_SESSION["Sdatabase"];

$host = $_SESSION["Shost"];
$username = $_SESSION["Suser"];
$password = $_SESSION["Spass"];
$database = $_SESSION["Sdatabase"];

$connect = mysql_connect($host,$username,$password) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
mysql_select_db($database) or die ("ไม่พบฐานข้อมูล $database");
mysql_query("SET character_set_results=tis-620");
mysql_query("SET NAMES TIS620");
