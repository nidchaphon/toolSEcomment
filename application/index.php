<?php

session_start();

include ("../config/config.inc.php");

$strHost = $_POST["host"];
$strUser = $_POST"user";
$strPass = "pass";
$strDatabase = "database";

echo $strHost;

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tool Comment</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../common/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Core JS -->
    <script src="../../common/js/jquery.js"></script>
    <script src="../../common/js/bootstrap.min.js"></script>

</head>

<body>
<!-- Page Content -->
<div class="container">
    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Host</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="host" placeholder="192.168.xx.xxx">
                <button type="submit" class="btn btn-default">Test config</button>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="user">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pass">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Data Base</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="database">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">NEXT >></button>
            </div>
        </div>
    </form>
</div>
<!-- /.container -->
</body>

</html>

