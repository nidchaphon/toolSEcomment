<?php
include ("../config/config.inc.php");

// ดึงข้อมูลหน้าหลัก
include ("../common/class.detail.php");
$detail_list = new detail();

if (!isset($_GET['db_name'])){
    $dbname = $db;
}else{
    $dbname = $_GET['db_name'];
}

$tbName = $_GET['tb_name'];
$table_list = $detail_list->getTableList($db,$tbName);
$title_comment = $detail_list->getTitleComment($db,$dbname,$tbName);
?>


