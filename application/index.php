<?php

session_start();
session_destroy();
include ("../config/config.inc.php");

if (isset($_POST))
{
	$strHost     = @$_POST['txtHost'];
	$strUser     = @$_POST["txtUser"];
	$strPass     = @$_POST["txtPass"];
	$strDatabase = @$_POST["txtDatabase"];

	$_SESSION["host"]     = $strHost;
	$_SESSION["user"]     = $strUser;
	$_SESSION["pass"]     = $strPass;
	$_SESSION["database"] = $strDatabase;

	session_write_close();
}
	echo $_SESSION["host"];
//	if (!$strHost)
//	{
//		echo "";
//
//	}
//	else
//	{
//
//		$connect = mysql_connect($strHost, $strUser, $strPass) or die ("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
//		mysql_select_db($database) or die ("ไม่พบฐานข้อมูล $strDatabase");
//		mysql_query("SET character_set_results=tis-620");
//		mysql_query("SET NAMES TIS620");
//
//	$_SESSION["host"] = $strHost;
//	$_SESSION["user"] = $strUser;
//	$_SESSION["pass"] = $strPass;
//	$_SESSION["database"] = $strDatabase;
//	session_write_close();
//
//		header("location:test.php");
//	}
//}
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
                <input type="text" class="form-control" id="txtHost" name="txtHost" placeholder="192.168.xx.xxx">
                <button type="submit" class="btn btn-default">Test config</button>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtUser" name="txtUser">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtPass" name="txtPass">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Data Base</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtDatabase" name="txtDatabase">
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

