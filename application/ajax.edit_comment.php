<?php
/**
 * Created by PhpStorm.
 * User: crystal
 * Date: 19/12/2559
 * Time: 11:44
 */
header('Content-Type: text/html; charset=tis-620');

session_start();
require_once("../config/config.inc.php"); #อ้างหาค่า Define

include ("../common/class.detail.php");
$detail_list = new detail();
$list = $detail_list->getDetailTablelList($db);

function encode_items($array, $in, $out)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = encode_items($value, $in, $out);
        } else {
            $array[$key] = iconv($in, $out, $value);
        }
    }
    return $array;
}

$_GET = encode_items($_GET, 'utf-8', 'tis-620');
$tbName = $_GET['tb_name'];
$tb_comment = $_GET['tb_comment'];

echo $sql = "ALTER TABLE tb_name = $tbName COMMENT '$tb_comment'";
//mysql_db_query($db,"SET NAMES TIS620");
//$rsConn = mysql_db_query($db, $sql);


?>