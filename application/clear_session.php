<?php
/**
 * Created by PhpStorm.
 * User: nidchaphon
 * Date: 12/22/2016 AD
 * Time: 11:46
 */

session_start();
session_destroy();

header("location:index.php");
?>