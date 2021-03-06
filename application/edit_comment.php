<?php
session_start();

$host =  $_SESSION["Shost"];
$user = $_SESSION["Suser"];
$pass = $_SESSION["Spass"];
$db = $_SESSION["Sdatabase"];

include ("../config/config.inc.php");

// ดึงข้อมูลหน้าหลัก
include ("../common/class.detail.php");
$detail_list = new detail();

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tool comment</title>
    <link rel="stylesheet" href="../common/css/style.css">
    <link rel="stylesheet" href="../common/css/style_menu.css">
    <link rel="stylesheet" href="../common/bootstrap/css/bootstrap.min.css">
    <link href="../common/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../common/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../common/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../common/css/style_tool.css">

    <script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
    <script src="../common/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
    <script src="../common/js/purl.js"></script>
    <script src="../common/vendor/jquery/jquery.min.js"></script>
    <script src="../common/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../common/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../common/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../common/vendor/datatables-responsive/dataTables.responsive.js"></script>
</head>
<?php
$list = $detail_list->getDetailList($db); // ข้อมูลตาราง
//echo '<pre>';print_r($list);echo '</pre>';
?>
<body>
<style>
    *{
        font-size: 20px;
        font-family: 'THSarabunNew', 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
</style>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

<div class="row" style="margin: 15px;">
    <div class="col-lg-12" style="padding: 0 0 0 0;">

    </div>
    <!-- /.col-lg-12 -->
</div>


</body>
</html>
