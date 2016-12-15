<?php

session_start();

include ("../config/config.inc.php");

$strHost = $_POST["host"];
$strUser = $_POST["user"];
$strPass = "pass";
$strDatabase = "database";

echo $strHost;

?>

<!DOCTYPE html>
<html lang="th">

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Tool comment</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style_menu.css">
<link rel="stylesheet" href="../../common/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../../common/sweetalert/dist/sweetalert.css">
<link rel="stylesheet" href="../package/jquery-ui/jquery-ui.css">
<link rel="stylesheet" href="../../common/global/css/dashboard_style.css">

<script src="../../common/js/jquery1.12.4.js" type="text/javascript"></script>
<script src="../../common/sweetalert/dist/sweetalert.min.js"></script>
<script src="../fancybox/jquery.mousewheel-3.0.4.pack.js" type="text/javascript"></script>
<script src="../../common/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
<script src="../../common/js_script/jquery-1.8.2.js" type="text/javascript"> </script>
<script src="../package/jquery-ui/jquery-ui-thai.js" type="text/javascript"></script>
<script src="../../common/js/purl.js"></script>

</head>

<body>
<!-- Page Content -->
<div class="container">
    <form class="form-horizontal">
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
