<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/15/2016 AD
 * Time: 13:27
 */
if (!isset($_SESSION)){
    session_start();
}
echo $_SESSION["host"];
echo $_SESSION["user"];
echo $_SESSION["pass"];
echo $_SESSION["database"];