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
    <link href="../common/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../common/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../common/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../common/css/sweetalert.css">
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
$tbName = $_GET['tb_name'];
$tb_comment = $_GET['tb_comment'];
$list = $detail_list->getDetailList($db); // ข้อมูลตาราง
$table_list = $detail_list->getTableList($db,$tbName,$tb_comment);

//echo '<pre>';print_r($tb_comment);echo '</pre>';
?>
<body>
<div class="row" style="margin: 15px;">
    <div class="col-lg-12" style="padding: 0 0 0 0;">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 24px; text-align: center; font-weight: bold">
                Table Name : <?php echo $tb_name; ?><br>
                <form class="form-inline">
                    <div class="form-group">
                        Comment : <input type="text" class="form-control editComment" id="editComment"
                                         style="margin: auto; display: inline-block; font-size: 20px;" value="<?php echo $tb_comment; ?>">
                        <button type="button" class="btn btn-success"
                                onclick="detail_edit('update','<?= $tb_name ?>','<?= $tb_comment?>')"
                        >แก้ไข</button>
                    </div>
                </form>
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
                            <td style="vertical-align: middle;"><?php echo $val['tb_comment']; ?></td>
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

<script>
//    function detail_edit(mode,TBName,TBComment){
//        var tb_name = '<?//=$_GET['tb_name']?>//';
//        var tb_comment = '<?//=$_GET['tb_comment']?>//';
//
//        var sent = "ajax.edit_comment.php?mode="+mode+"&tb_name="+TBName+"&tb_comment="+TBComment;
//        console.log(mode);
//        $.ajax({
//            dataType: "POST",
//            url: sent,
//            success: function (data, textStatus){
//                console.log();
//                $("#id_detail_1").html(data);
//            }
//        });
//
//    }
</script>


</body>
</html>
