<?php
echo $_SESSION["Shost"];
echo $_SESSION["Suser"];
echo $_SESSION["Spass"];
echo $_SESSION["Sdatabase"];

$host = $_SESSION["Shost"];
$username = $_SESSION["Suser"];
$password = $_SESSION["Spass"];
$database = $_SESSION["Sdatabase"];

$connect = mysql_connect($host,$username,$password) or die ("�������ö�������Ͱҹ��������");
mysql_select_db($database) or die ("��辺�ҹ������ $database");
mysql_query("SET character_set_results=tis-620");
mysql_query("SET NAMES TIS620");
