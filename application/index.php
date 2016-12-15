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
<link rel="stylesheet" href="../common/css/style.css">
<link rel="stylesheet" href="../common/css/style_menu.css">
<link rel="stylesheet" href="../common/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../common/font/fontawesome-webfont.eot">
<link rel="stylesheet" href="../common/css/style_tool.css">

<script src="../common/js/jquery1.12.4.js" type="text/javascript"></script>
<script src="../common/bootstrap/js/bootstrap.min.js" type="text/javascript"> </script>
<script src="../common/js/purl.js"></script>


</head>
<style>
    *{
        font-family: 'THSarabunNew', 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

</style>
<body>

<div class="text-center" style="padding:50px 0">
    <h1 style="font-weight: bold; font-size: 30px" >ค้นหาคอมเม้น</h1>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="login-form" class="text-left">
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="host" class="sr-only">Host</label>
                        <input type="text" class="form-control" id="host" name="host" placeholder="host">
                    </div>
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="database" class="sr-only">DataBase</label>
                        <input type="text" class="form-control" id="database" name="database" placeholder="database">
                    </div>
                    <div class="form-group" style="text-align: center; margin-top: 20px;">
                        <button type="button" class="btn btn-primary" style="width: 30%; font-size: 20px;">Test Host</button>
                        <button type="button" class="btn btn-success" style="width: 30%; font-size: 20px;">Next >></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

</body>

</html>
