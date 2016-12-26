<?php
session_start();

include ("../config/config.inc.php");

$host =  $_SESSION["Shost"];
$user = $_SESSION["Suser"];
$pass = $_SESSION["Spass"];
$db = $_SESSION["Sdatabase"];

include ("../common/class.detail.php");
$detail_list = new detail();

if (!isset($_GET['tb_name'])){
    $tbName = $_SESSION['tb_name'];
}else {
    $tbName = $_GET['tb_name'];
    $_SESSION['tb_name'] = $_GET['tb_name'];
}

if (!isset($_POST['list_field'])){
    if (!isset($_SESSION['listfield'])){
        $listtb = "list_all";
    }else{
        $listtb = $_SESSION['listfield'];
    }
}else{
    $listtb = $_POST['list_field'];
}

$_SESSION['listfield'] = $listtb;
$listby = $_SESSION['listfield'];

if ($listby == 'list_all'){
    $checkRadio1 = "checked";
}elseif ($listby == 'list_comment'){
    $checkRadio2 = "checked";
}elseif ($listby == 'list_nocomment'){
    $checkRadio3 = "checked";
}

$field_list = $detail_list->getDetailFieldList($db,$tbName,$listby);
$count_field = $detail_list->getCountField($db,$tbName);

//echo '<pre>';print_r($count_field);echo '</pre>';
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
                    <div class="col-md-1"><a href="table_detail.php"><button type="button" class="btn btn-info">รายการตาราง</button></a></div>
                    <div class="col-md-9">รายการฟิลด์ในตาราง <?php echo $tbName; ?>
                        <form action="table_field_detail.php" method="post">
                            <input type="radio" class="form-check-input" name="list_field" id="list_fieldAll" value="list_all" onclick='this.form.submit()' <?php echo $checkRadio1; ?> > ทั้งหมด <?php echo $count_field[0]['numfieldall'];?> รายการ &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="list_field" id="list_fieldCommnet" value="list_comment" onclick='this.form.submit()' <?php echo $checkRadio2; ?> > มีคอมเม้น <?php echo $count_field[0]['numfieldcomment'];?> รายการ &nbsp;&nbsp;
                            <input type="radio" class="form-check-input" name="list_field" id="list_fieldNoComment" value="list_nocomment" onclick='this.form.submit()' <?php echo $checkRadio3; ?> > ไม่มีคอมเม้น <?php echo $count_field[0]['numfieldnocomment'];?> รายการ &nbsp;&nbsp;
                        </form>
                        <p>แก้ไขคอมเม้นแล้ว : <?php if ($_SESSION['count'] == ''){echo "0";}else{echo $_SESSION['count'];} ?> รายการ</p>
                    </div>
                </div>

            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example"
                       style="width: 80%; margin: auto;">
                    <thead>
                    <tr>
                        <th style="width: 20%; text-align: center">ฟิลด์</th>
                        <th style="width: 15%; text-align: center">ประเภทข้อมูล</th>
                        <th style="width: 40%; text-align: center">คอมเม้น</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($field_list AS $val){
                        if ($val['col_comment'] == '') {
                            $trStyle = "background: #FF9797";
                        }else {
                            $trStyle = "";
                        }?>
                        <tr class="odd gradeX" style="<?php echo $trStyle; ?>">
                            <td style="vertical-align: middle;">
                                <div class="row">
                                    <div class="col-md-9">
                                        <?php echo $val['col_name']; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        if ($val['col_key'] == 'PRI'){
                                            echo "<i class='fa fa-key' title='Primary KEY'></i>";
                                        } ?>
                                    </div>
                                </div>
                                </td>
                            <td style="vertical-align: middle;"><?php echo $val['col_type']; ?></td>
                            <td style="vertical-align: middle;">
                                <div class="row">
                                    <div class="col-md-10"><?php echo $val['col_comment']; ?></div>
                                    <div class="col-md-1"><a href="table_field_comment.php?tb_name=<?php echo $val['tb_name']; ?>&col_name=<?php echo $val['col_name']; ?>"><i class="fa fa-comment" title="เลือกคอมเม้นนี้"></i></a></div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
