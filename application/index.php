<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();

$strHost = $_POST['txtHost'];
$strUser = $_POST['txtUsername'];
$strPass = $_POST['txtPassword'];
$strDatabase = $_POST['txtDatabase'];

$_SESSION['Shost'] = $strHost;
$_SESSION['Suser'] = $strUser;
$_SESSION['Spass'] = $strPass;
$_SESSION['Sdatabase'] = $strDatabase;
session_write_close();

$connect = mysql_connect($strHost,$strUser,$strPass);
$select_db = mysql_select_db($strDatabase,$connect);

if (isset($_POST['btNext'])) {
		if ($connect && $select_db) {
			$frmAction = $_SERVER['PHP_SELF'];
            header("location: table_detail.php");
		} else {
			$frmAction = "testdb.php";
            $iframe = "frmMain.target='iframe_target';";
		}
		mysql_close($connect);
}

?>

<script language="JavaScript">
    function showResult(statustestdb)
    {
        if (statustestdb==1)
        {
            document.getElementById("divResult").innerHTML = "<font color=green> เชื่อมต่อฐานข้อมูลสำเร็จ! </font>  <br>";
        }
        if (statustestdb==2)
        {
            document.getElementById("divResult").innerHTML = "<font color=red> ผิดพลาด!! ไม่สามารถเชื่อมต่อฐานข้อมูลได้ </font> <br>";
        }
        if (statustestdb==3)
        {
            document.getElementById("divResult").innerHTML = "<font color=red> ผิดพลาด!! กรุณากรอกข้อมูลให้ครบ </font> <br>";
        }

    }

    function fncBTTest()
    {
        frmMain.action='testdb.php'
        frmMain.target='iframe_target';
        frmMain.submit();
    }

    function fncBTNext()
    {
        frmMain.action='<?php echo $frmAction; ?>'
        <?php echo $iframe; ?>
        frmMain.submit();
    }
</script>

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

</style>
<body>

<div class="text-center" style="padding:50px 0">
    <h1 style="font-weight: bold; font-size: 30px" >ค้นหาคอมเม้น</h1>
    <!-- Main Form -->
    <div class="login-form-1">
        <form name="frmMain" class="text-left" method="POST">
            <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
            <div id="divResult" align="center"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="host" class="sr-only">Host</label>
                        <input type="text" class="form-control css-require" name="txtHost" id="txtHost" placeholder="host">
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
                        <button type="submit" name="btTest" OnClick="fncBTTest()" class="btn btn-primary" style="width: 30%; font-size: 20px;">Test Host</button>
                        <button type="submit" name="btNext" OnClick="fncBTNext()" class="btn btn-success" style="width: 30%; font-size: 20px;">Next >></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

</body>

</html>