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
    $listby = "list_all";
}else{
    $listby = $_POST['list_tb'];
}

if ($listby == 'list_all'){
    $checkRadio1 = "checked";
}elseif ($listby == 'list_comment'){
    $checkRadio2 = "checked";
}elseif ($listby == 'list_nocomment'){
    $checkRadio3 = "checked";
}
// �֧������˹����ѡ
include ("../common/class.detail.php");
$detail_list = new detail();

$tb_list = $detail_list->getDetailTablelList($db,$listby); // �����ŵ��ҧ
$db_list = $detail_list->getDatabaseList($db);

echo $listby;
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
    <link rel="stylesheet" href="../common/bootstrap/css/bootstrap.css">
    <link href="../common/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../common/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../common/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../common/css/style_tool.css">

    <script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
    <script src="../common/bootstrap/js/bootstrap.js" type="text/javascript"> </script>
    <script src="../common/js/purl.js"></script>
    <script src="../common/vendor/jquery/jquery.js"></script>
    <script src="../common/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="../common/vendor/datatables/js/jquery.dataTables.js"></script>
    <script src="../common/vendor/datatables-plugins/dataTables.bootstrap.js"></script>
    <script src="../common/vendor/datatables-responsive/dataTables.responsive.js"></script>
</head>

<body>
    <div class="row" style="margin: 15px;">
        <div class="col-lg-12" style="padding: 0 0 0 0;">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 24px; text-align: center; font-weight: bold">
                    <div class="row">
                        <div class="col-md-1"><a href="index.php?clear_ss=clear"><button type="button" class="btn btn-info">��駤������</button></a></div>
                        <div class="col-md-11">Table List Database :
                            <form action="table_detail.php" method="post">
                            <select class="select" name="selectdb" onchange='this.form.submit()'>
                                <option value="<?php echo $db; ?>"><?php echo $db; ?></option>
                                <?php foreach ($db_list AS $listdb){ ?>
                                <option value="<?php echo $listdb['db_name']; ?>"><?php echo $listdb['db_name']; ?></option>
                                <?php } ?>
                            </select>&nbsp;
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbAll" value="list_all" onclick='this.form.submit()' <?php echo $checkRadio1; ?> > ������ &nbsp;
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbCommnet" value="list_comment" onclick='this.form.submit()' <?php echo $checkRadio2; ?> > �դ����� &nbsp;
                                <input type="radio" class="form-check-input" name="list_tb" id="list_tbNoComment" value="list_nocomment" onclick='this.form.submit()' <?php echo $checkRadio3; ?> > ����դ�����
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
                            <th style="width: 20%">�ҹ������</th>
                            <th style="width: 20%">���ҧ</th>
                            <th style="width: 40%">������</th>
                            <th style="width: 10%">����������</th>
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
                            <td style="vertical-align: middle;" align="center">
                                <a href="table_comment.php?db_name=<?php echo $val['db_name']; ?>&tb_name=<?php echo $val['tb_name']; ?>"><i class="fa fa-plus-square"></i></a></td>
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
