<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/21/2016 AD
 * Time: 09:18
 */
//include ("../config/config.inc.php");
session_start();

$host =  $_SESSION["Shost"];
$username = $_SESSION["Suser"];
$password = $_SESSION["Spass"];
$database = $_SESSION["Sdatabase"];

$connect = mysql_connect($host,$username,$password);
mysql_select_db($database);
mysql_query("SET character_set_results=tis-620");
mysql_query("SET NAMES TIS620");

$tbName = $_GET['tb_name'];
$comment = $_POST['txtComment'];


if (isset($_POST['update_comment'])){
    $sql = "ALTER TABLE $tbName COMMENT '$comment'";
    mysql_query($sql) or die(mysql_error());

    header("location:table_detail.php");
}