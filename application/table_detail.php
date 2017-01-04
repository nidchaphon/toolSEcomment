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

$db_list = $detail_list->getDatabaseList($db);
$count_tb = $detail_list->getCountTable($db);
$table_list = $detail_list->getDetailTablelList($db,$listby); // ข้อมูลตาราง

//echo '<pre>';print_r($comment_list);echo '</pre>';

if ($_GET['Action'] == 'update'){
    for ($i = 1; $i <= $_POST["hdnLine"]; $i++) {
        if ($_POST["txtComment$i"] != ''){
            $txttbname = $_POST["txtTBname$i"];
            $txtcomment = $_POST["txtComment$i"];
            $sqlUpdate = "ALTER TABLE $txttbname COMMENT '$txtcomment' ";
            mysql_query($sqlUpdate) or die(mysql_error());
            header("location:table_detail.php");
            $_SESSION['count'] = $_SESSION['count'] + 1;
        }
    }
}

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
                        <div class="col-md-2"></div>
                        <div class="col-md-6">รายการตารางในฐานข้อมูล
                            <form name="form_listdb" action="table_detail.php" method="post">
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

                    </div>

                </div>
                <!-- /.panel-heading -->
                <form name="form_updatecomment" action="table_detail.php?Action=update" method="post">
                <div class="panel-body">
                    <div class="row" align="center"><button type="submit" name="update_comment" class="btn btn-success" style="width: 200px;">Update</button></div><br>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                    style="width: 80%; margin: auto;">
                        <thead>
                        <tr>
                            <th style="width: 20%; text-align: center">ตาราง</th>
                            <th style="width: 40%; text-align: center">คอมเม้น</th>
                            <th style="width: 10%; text-align: center">จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=0;
                        foreach ($table_list AS $key => $val_tb){
                            $i = $i + 1;
                            $tbName = $val_tb['tb_name'];
                            $comment_list = $detail_list->getComment($db,$tbName);
//                            echo '<pre>';print_r($comment_list);echo '</pre>';
                            $count_cm =  count($comment_list);
                            echo $count_cm;
                            foreach ($comment_list AS $val_cm){
                                echo $val_cm['tb_comment'];
                            }


                            if ($val_tb['tb_comment'] == '') {
                                $trStyle = "background: #FF9797";
                                if ($count_cm > 1){
                                    $comment = "<input type='text' class='form-control editComment' id='txtComment' name='txtComment".$i."' value='" . $comment_list[0]['tb_comment'] . "'>
                                                &nbsp;
                                                 <a href='' onclick='load_data('".$val_tb['tb_name']."')' data-toggle='modal' data-target='.bs-example-modal-table' >
                                                 <i class='fa fa-reorder (alias)' title='เลือกคอมเม้น'></i></a>";
                                }else{
                                    $comment = "<input type='text' class='form-control editComment' id='txtComment' name='txtComment".$i."' placeholder='ไม่พบคอมเม้นในฐานข้อมูลอื่น' value='" . $comment_list[0]['tb_comment'] . "'>";
                                }
                            }else {
                                $trStyle = "";
                                $comment = "<input type='hidden' id='txtComment' name='hdnComment".$i."' value='" . $val_tb['tb_comment'] . "'>".$val_tb['tb_comment'];
                            }
                            ?>
                        <tr class="odd gradeX" style="<?php echo $trStyle; ?>">
                            <td style="vertical-align: middle;"><?php echo $val_tb['tb_name']; ?>
                                <input type="hidden" name="txtTBname<?php echo $i;?>" value="<?php echo $val_tb['tb_name'];?>"></td>
                            <td style="vertical-align: middle;"><?php echo $comment;  ?></td>
                            <td style="vertical-align: middle;" align="center">
<!--                                <a href="table_field_detail.php?tb_name=--><?php //echo $val['tb_name']; ?><!--"><i class="fa fa-reorder (alias)" title="จัดการฟิลด์"></i></a> &nbsp;-->
                                <a href="table_comment.php?db_name=<?php echo $val_tb['db_name']; ?>&tb_name=<?php echo $val_tb['tb_name']; ?>"><i class="fa fa-comment" title="แก้ไขคอมเม้น"></i></a></td>
                        </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="hdnLine" value="<?php echo $i;?>">
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
                </form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>


<!--    <a href="" onclick="load_data('id ของพนักงาน')" data-toggle="modal" data-target=".bs-example-modal-table" >-->
        /////// modal</a>
        <div class="modal fade bs-example-modal-table" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h4 class="modal-title">ข้อมูลการลาทั้งหมด</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body no-padding">
                            <div class="table-responsive" style="height:500px;">
                                <div id="divDataview">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script type="text/javascript">
            function load_data($val_tb['tb_name']) {
                var sdata = {
                    id: $val_tb['tb_name']
                };
                $('#divDataview').load('url ไปที่หน้าสร้าง ไว้สำหรับ select ข้อมูลนั้นเช่น ข้อมูลบุคคล.php', sdata);
            }
        </script>


    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
</body>
</html>