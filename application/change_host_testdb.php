<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

$strHost = $_POST['txtHost'];
$strUser = $_POST['txtUsername'];
$strPass = $_POST['txtPassword'];
$strDatabase = $_SESSION['Sdatabase'];

$_SESSION['Shost'] = $strHost;
$_SESSION['Suser'] = $strUser;
$_SESSION['Spass'] = $strPass;
//$_SESSION['Sdatabase'] = $strDatabase;
session_write_close();

$connect = mysql_connect($strHost,$strUser,$strPass);
$select_db = mysql_select_db($strDatabase,$connect);

if ($strHost == '') {
    echo "<script language='javascript'> alert('��سҡ�͡���������ú !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
}elseif ($strUser == '') {
    echo "<script language='javascript'> alert('��سҡ�͡���������ú !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
}elseif ($strPass == '') {
    echo "<script language='javascript'> alert('��سҡ�͡���������ú !!!'); </script>";
    echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
}else {
    if (isset($_POST['btTest'])) {
        if ($connect && $select_db) {
            echo "<script language='javascript'> alert('�������Ͱҹ�����������'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
        } else {
            echo "<script language='javascript'> alert('�������ö�������Ͱҹ�������� !!! ��سҵ�Ǩ�ͺ�������ա����'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
        }
    } elseif (isset($_POST['btNext'])) {
        if ($connect && $select_db) {
            unset($_SESSION["Sdatabase"]);
            header("Location:table_detail.php");
        } else {
            echo "<script language='javascript'> alert('�������ö�������Ͱҹ�������� !!! ��سҵ�Ǩ�ͺ�������ա����'); </script>";
            echo "<meta http-equiv='refresh' content='0;url=change_host.php'>";
        }
    }
}
