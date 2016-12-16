<?php
$strHost = $_POST['txtHost'];
$strUser = $_POST['txtUsername'];
$strPass = $_POST['txtPassword'];
$strDatabase = $_POST['txtDatabase'];

$connect = mysql_connect($strHost,$strUser,$strPass);
$select_db = mysql_select_db($strDatabase,$connect);


if ($strHost == '') {
    echo "<script>window.top.window.showResult('3');</script>";
}elseif ($strUser == '') {
    echo "<script>window.top.window.showResult('3');</script>";
}elseif ($strPass == '') {
    echo "<script>window.top.window.showResult('3');</script>";
}elseif ($strDatabase == '') {
    echo "<script>window.top.window.showResult('3');</script>";
} else {

    if ($connect && $select_db) {
        echo "<script>window.top.window.showResult('1');</script>";
    } else {
        echo "<script>window.top.window.showResult('2');</script>";
    }
}

mysql_close($connect);