<?php
session_start();

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
<link rel="stylesheet" href="../common/font/fontawesome-webfont.eot">

<script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
<script src="../common/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
<script src="../common/js/purl.js"></script>
</head>
<?php
$list = $detail_list->getDetailList();
//echo '<pre>';print_r($list);echo '</pre>';
?>
<body>
<style>
    .table-hover>tbody>tr:hover{
        background-color: #ebfbff !important;
    }

    thead{
        background-color: #e0e0e0 !important;
    }

    thead>tr>td{
        font-weight: bold;
    }
</style>
<div class="row" style="margin: 10px !important;">
    <table class="table table-hover table-bordered table-striped" style="width: 50%; margin: auto;">
        <thead>
        <tr>
            <td style="vertical-align: middle; width: 80%;" align="center">ตาราง</td>
            <td style="vertical-align: middle; width: 80%;" align="center">เลือก</td>
        </tr>
        </thead>
        <tbody>
        <?php
//        foreach ($list as $val){
        ?>
        <tr>
            <td style="vertical-align: middle;">
                <?php echo $val['TABLE_SCHEMA'] ?>
            </td>
            <td style="vertical-align: middle;" align="center">
                <input type="checkbox" id="inlineCheckbox" value="option">
            </td>
        </tr>
        <?php
//        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
