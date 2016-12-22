<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/21/2016 AD
 * Time: 09:18
 */
//include ("../config/config.inc.php");
session_start();

$host =  $_SESSION["Shost"];
$username = $_SESSION["Suser"];
$password = $_SESSION["Spass"];
$database = $_SESSION["Sdatabase"];
$comment = $_SESSION['comment'];

$connect = mysql_connect($host,$username,$password);
mysql_select_db($database);
mysql_query("SET character_set_results=tis-620");
mysql_query("SET NAMES TIS620");

$tbName = $_GET['tb_name'];
$txtcomment = $_POST['txtComment'];
$comment = $_GET['comment'];

echo $comment;
if (isset($_POST['comfirm_update'])){
    $sql = "ALTER TABLE $tbName COMMENT '$comment'";
    mysql_query($sql,$connect) or die(mysql_error());

    $_SESSION['count'] = $_SESSION['count']+1;

    header("location:table_detail.php?tb_name=".$tbName);
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="TIS-620">
    <title>Tool comment</title>

    <link rel="stylesheet" href="../common/bootstrap/css/bootstrap.min.css">
    <script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
    <script src="../common/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).load(function()
        {
            $('#myModal').modal('show');
        });
    </script>
</head>
<body>

<div class="container">
    <!-- Trigger the modal with a button -->
<!--    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Comfirm Query</h4>
                </div>
                <div class="modal-body">
                    <p><?php echo "ALTER TABLE ".$tbName." COMMENT '".$txtcomment."'"; ?></p><br>
                    <p><strong>แก้ไขคอมเม้น ตาราง</strong> <?php echo $tbName.' <strong>ให้เป็น</strong> "'.$txtcomment.'"<br> <strong>ฐานข้อมูล</strong> '.$database;?> </p>
                </div>
                <div class="modal-footer">
                    <form action="update_comment_to_db.php?tb_name=<?php echo $tbName; ?>&comment=<?php echo $txtcomment; ?>" method="post">
                        <button type="submit" name="comfirm_update" class="btn btn-primary">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location='table_comment.php?tb_name=<?php echo $tbName; ?>'">Cancel</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
