<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

$strHost = $_POST['txtHost'];
$strUser = $_POST['txtUsername'];
$strPass = $_POST['txtPassword'];
$strDatabase = $_POST['txtDatabase'];

$_SESSION['Shost'] = $strHost;
$_SESSION['Suser'] = $strUser;
$_SESSION['Spass'] = $strPass;
$_SESSION['Sdatabase'] = $strDatabase;
session_write_close();

$connect = mysql_connect($strHost,$strUser,$strPass);
$select_db = mysql_select_db($strDatabase,$connect);

if ($strHost == '') {
    echo "<script language='javascript'> alert('กรุณากรอกข้อมูลให้ครบ !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}elseif ($strUser == '') {
    echo "<script language='javascript'> alert('กรุณากรอกข้อมูลให้ครบ !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}elseif ($strPass == '') {
    echo "<script language='javascript'> alert('กรุณากรอกข้อมูลให้ครบ !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}elseif ($strDatabase == '') {
    echo "<script language='javascript'> alert('กรุณากรอกข้อมูลให้ครบ !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
    if (isset($_POST['btTest'])) {
        if ($connect && $select_db) {
            echo "<script language='javascript'> alert('เชื่อมต่อฐานข้อมูลสำเร็จ'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        } else {
            echo "<script language='javascript'> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้ !!! กรุณาตรวจสอบข้อมูลอีกครั้ง'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        }
    } elseif (isset($_POST['btNext'])) {
        if ($connect && $select_db) {
            header("Location:table_detail.php");
        } else {
            echo "<script language='javascript'> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้ !!! กรุณาตรวจสอบข้อมูลอีกครั้ง'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        }
    }
}
