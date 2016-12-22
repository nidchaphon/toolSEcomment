<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

if ($_GET['clear_ss']=='clear'){
    session_destroy();
}else{
    session_start();
}

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

<body>

<div class="text-center" style="padding:50px 0">
    <h1 style="font-weight: bold; font-size: 30px" >ค้นหาคอมเม้น</h1>
    <!-- Main Form -->
    <div class="login-form-1">
        <form name="frmMain" class="text-left" action="change_host_testdb.php" method="POST">
            <div id="divResult" align="center"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="host" class="sr-only">Host</label>
                        <input type="text" class="form-control css-require" name="txtHost" id="txtHost" placeholder="Host" value="<?php echo $_SESSION['Shost']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Username" value="<?php echo $_SESSION['Suser']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Password" value="<?php echo $_SESSION['Spass']; ?>">
                    </div>
                    <div class="form-group" style="text-align: center; margin-top: 20px;">
                        <input type="submit" name="btTest" id="btTest" value="TestHost" class="btn btn-primary" style="width: 30%; font-size: 20px;">
                        <input type="submit" name="btNext" id="btNext" value="Next" class="btn btn-success" style="width: 30%; font-size: 20px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

</body>

</html>