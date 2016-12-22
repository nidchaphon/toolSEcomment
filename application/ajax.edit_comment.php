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

$dbname = $_GET['db_name'];
$tbName = $_GET['tb_name'];
$table_list = $detail_list->getTableList($db,$tbName);
$title_comment = $detail_list->getTitleComment($db,$dbname,$tbName);

?>

<head>

    <link rel="stylesheet" href="../common/sweetalert/dist/sweetalert.css">
    <script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
    <script src="../common/sweetalert/dist/sweetalert.min.js"></script>

</head>
<form  id="formpay" name="formpay" class="form-horizontal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="row" style="margin: 10px 15px;">
            <form class="form-inline" name="frmUpdateComment">
                Table Name :
                <div class="form-group">
                    <?php echo $tbName ; ?>
                </div>
            </form>
            <form class="form-inline" name="frmUpdateComment">
                Comment :
                <div class="form-group">
                    <input type="text" class="form-control editComment" id="txtComment" name="txtComment" value="<?php echo $title_comment[0]['tb_comment']; ?>" style="margin: auto; display: inline-block; font-size: 20px;" >
                </div>
            </form>
        </div>
    </div>
    <div class="modal-body">
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
                            <div class="col-md-2">
<!--                                <a href="ajax.edit_comment.php?frame=dr_doc1&tab=2&db_name=--><?php //echo $val['db_name']; ?><!--&tb_name=--><?php //echo $val['tb_name']; ?><!--">-->
<!--                                    <i class="fa fa-reply" title="เลือกคอมเม้นนี้"></i>-->
<!--                                </a>-->
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button style="font-size:20px" class="btn btn-success" type="button" id="btnok" name="submit">บันทึก</button>
        <button type="button" class="btn btn-danger" style="width:100px;height:40px;font-size:18px"
                id="cancel" name="cancel" data-dismiss="modal" >ยกเลิก</button>
    </div>
</form>

<script>
    $(document).ready(function () {

        $("#btnok").click(function() {
            var alert_text = '';
            if (alert_text == '') {
                checkSave();
            }else{
                swal({
                        title: 'กรุณากรอกข้อมูลให้ครบ',
                        text: alert_text,
                        type: "error",
                        confirmButtonText: "ตกลง",
                        closeOnConfirm: false
                    },
                    function () {
                        swal.close();
                    });
            }

            function checkSave(){
                var dbName = '<?=$_GET['db_name']?>';
                var tbName = '<?=$_GET['tb_name']?>';
                swal({
                    title: "ต้องการบันทึกข้อมูลใช่หรือไม่",
                    type: "warning", showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "ตกลง",
                    cancelButtonText: "ยกเลิก",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    customClass: "THsarabun"
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: 'update_comment_to_db.php',
                            data: {
                                db_name: db_name,
                                tb_name: tb_name,
                                withhold_id: $('#txtComment').val(),
                            },
                            success: function (data, textStatus) {
                                //console.log(data);
                                swal({
                                    title: "สำเร็จ!",
                                    text: "บันทึกข้อมูลการระงับสิทธิ์เรียบร้อยแล้ว",
                                    type: "success",
                                    showConfirmButton: true,
                                    timer: 1000,
                                }, function () {
                                    setTimeout(function () {
                                        window.location = "./table_detail.php?db_name="+db_name+"&tb_name="+tb_name;
                                    }, 1000);
                                });

                            }
                        });
                    } else {
                        swal({
                            title: "ยกเลิกการระงับสิทธิ์",
                            type: "error",
                            showConfirmButton: true

                        });
                    }
                });
        });
</script>