<?php
session_start();

include ("../config/config.inc.php");

$host =  $_SESSION["Shost"];
$user = $_SESSION["Suser"];
$pass = $_SESSION["Spass"];
//$db = $_SESSION["Sdatabase"];

if (isset($_POST['selectdb'])){
    $db = $_POST['selectdb'];
    unset($_SESSION["Sdatabase"]);
    $_SESSION["Sdatabase"] = $db;
}else{
    $db = $_SESSION["Sdatabase"];
}

if (!isset($_POST['list_tb'])){
    if (!isset($_SESSION['listtb'])){
        $listtb = "list_all";
    }else{
        $listtb = $_SESSION['listtb'];
    }
}else{
    $listtb = $_POST['list_tb'];
}

$_SESSION['listtb'] = $listtb;
$listby = $_SESSION['listtb'];

if ($listby == 'list_all'){
    $checkRadio1 = "checked";
}elseif ($listby == 'list_comment'){
    $checkRadio2 = "checked";
}elseif ($listby == 'list_nocomment'){
    $checkRadio3 = "checked";
}
// ดึงข้อมูลหน้าหลัก
include ("../common/class.detail.php");
$detail_list = new detail();

$tb_list = $detail_list->getDetailTablelList($db,$listby); // ข้อมูลตาราง
$db_list = $detail_list->getDatabaseList($db);
$count_tb = $detail_list->getCountTable($db);
$comment_list = $detail_list->getTableList($db,$tbName);
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
    <script src="../common/vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../common/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../common/vendor/datatables-responsive/dataTables.responsive.js"></script>
</head>

<body>
    <div class="row" style="margin: 15px;">
        <div class="col-lg-12" style="padding: 0 0 0 0;">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 24px; text-align: center; font-weight: bold">
                    <div class="row">
                        <div class="col-md-1"><a href="clear_session.php"><button type="button" class="btn btn-info">ตั้งค่าใหม่</button></a></div>
                        <div class="col-md-9">รายการตารางในฐานข้อมูล
                            <form action="table_detail.php" method="post">
                            <select class="select" name="selectdb" onchange='this.form.submit()'>
                                <option value="<?php echo $db; ?>"><?php echo $db; ?></option>
                                <?php foreach ($db_list AS $listdb){ ?>
                                <option value="<?php echo $listdb['db_name']; ?>"><?php echo $listdb['db_name']; ?></option>
                                <?php } ?>
                            </select><br>
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbAll" value="list_all" onclick='this.form.submit()' <?php echo $checkRadio1; ?> > ทั้งหมด <?php echo $count_tb[0]['numtball'];?> รายการ &nbsp;&nbsp;
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbCommnet" value="list_comment" onclick='this.form.submit()' <?php echo $checkRadio2; ?> > มีคอมเม้น <?php echo $count_tb[0]['numtbcomment'];?> รายการ &nbsp;&nbsp;
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbNoComment" value="list_nocomment" onclick='this.form.submit()' <?php echo $checkRadio3; ?> > ไม่มีคอมเม้น <?php echo $count_tb[0]['numtbnocomment'];?> รายการ &nbsp;&nbsp;
                            </form>
                            <p>แก้ไขคอมเม้นแล้ว : <?php if ($_SESSION['count'] == ''){echo "0";}else{echo $_SESSION['count'];} ?> รายการ</p>
                        </div>
<!--                        <div class="col-md-2" align="right"><a href="change_host.php?clear_ss=clear"><button type="button" class="btn btn-info">เปลี่ยน Host</button></a></div>-->
                    </div>

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                    style="width: 80%; margin: auto;">
                        <thead>
                        <tr>
                            <th style="width: 20%; text-align: center">ฐานข้อมูล</th>
                            <th style="width: 20%; text-align: center">ตาราง</th>
                            <th style="width: 40%; text-align: center">คอมเม้น</th>
                            <th style="width: 10%; text-align: center">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($tb_list as $val){
                            if ($val['tb_comment'] == '') {
                                $trStyle = "background: #FF9797";
                            }else {
                                $trStyle = "";
                            }
                            ?>
                        <tr class="odd gradeX" style="<?php echo $trStyle; ?>">
                            <td style="vertical-align: middle;"><?php echo $val['db_name']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $val['tb_name']; ?></td>
                            <td style="vertical-align: middle;"><?php echo $val['tb_comment']; ?></td>
<!--                            <td style="vertical-align: middle;">--><?php
//                                if ($val['tb_comment'] != ''){
//                                    echo $val['tb_comment'];
//                                }else{
//                                    ?>
<!--                                    <input type="text" class="form-control" id="txtComment" name="txtComment">-->
<!--                                --><?php //} ?><!--</td>-->
                            <td style="vertical-align: middle;" align="center">
<!--                                <a href="#" onclick="load_data('ccaa')" data-toggle="modal" data-target=".bs-example-modal-table" ><i class="fa fa-plus-square"></i></a>-->

                                <a href="table_field_detail.php?db_name=<?php echo $val['db_name']; ?>&tb_name=<?php echo $val['tb_name']; ?>"><i class="fa fa-reorder (alias)" title="จัดการฟิลด์"></i></a> &nbsp;
                                <a href="table_comment.php?db_name=<?php echo $val['db_name']; ?>&tb_name=<?php echo $val['tb_name']; ?>"><i class="fa fa-comment" title="แก้ไขคอมเม้น"></i></a></td>
                        </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
<!--                     /.table-responsive -->
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
