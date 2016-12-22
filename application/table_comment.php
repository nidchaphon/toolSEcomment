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

if (!isset($_GET['db_name'])){
    $dbname = $db;
}else{
    $dbname = $_GET['db_name'];
}

$tbName = $_GET['tb_name'];
$table_list = $detail_list->getTableList($db,$tbName);
$title_comment = $detail_list->getTitleComment($db,$dbname,$tbName);

//echo '<pre>';print_r($tb_comment);echo '</pre>';
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
    <link href="../common/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../common/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../common/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common/css/sweetalert.css">
    <link rel="stylesheet" href="../common/css/style_tool.css">

    <script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
    <script src="../common/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
    <script src="../common/js/purl.js"></script>
    <script src="../common/vendor/jquery/jquery.js"></script>
    <script src="../common/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../common/vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../common/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../common/vendor/datatables-responsive/dataTables.responsive.js"></script>
</head>

<body>
<div class="row" style="margin: 15px;">
    <div class="col-lg-12" style="padding: 0 0 0 0;">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 24px; font-weight: bold">
                <div class="row">
                    <div class="col-md-2"><a href="table_detail.php"><button type="button" class="btn btn-info">รายการตาราง</button></a></div>
                    <div class="col-md-2" style="text-align: right">Table Name :<br>Comment :</div>
                    <div class="col-md-8">
                         <?php echo $tb_name; ?><br>
                        <form class="form-inline" name="frmUpdateComment" action="update_comment_to_db.php?tb_name=<?php echo $tbName; ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control editComment" id="txtComment" name="txtComment" value="<?php echo $title_comment[0]['tb_comment']; ?>" style="margin: auto; display: inline-block; font-size: 20px;" >
                                <button type="submit" name="update_comment" class="btn btn-success">แก้ไข</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                       style="width: 80%; margin: auto;">
                    <thead>
                    <tr>
                        <th style="width: 20%">ฐานข้อมูล</th>
                        <th style="width: 20%">ตาราง</th>
                        <th style="width: 40%">คอมเม้น</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($table_list as $val){
                        ?>
                        <tr class="odd gradeX">
                            <td style="vertical-align: middle;"><?php echo $val['db_name']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $val['tb_name']; ?></td>
                            <td style="vertical-align: middle;">
                                <div class="row">
                                    <div class="col-md-10"><?php echo $val['tb_comment']; ?></div>
                                    <div class="col-md-1"><a href="table_comment.php?db_name=<?php echo $val['db_name']; ?>&tb_name=<?php echo $val['tb_name']; ?>"><i class="fa fa-reply" title="เลือกคอมเม้นนี้"></i></a></div>
                                </div>
                                 </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>
