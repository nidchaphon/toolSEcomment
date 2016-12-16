<?php

class detail
{
    function getDetailList($database){
        $result = array();
        $strQuery = "
            SELECT
                *
            FROM
              $database
        ";
        if($_GET['debug']=='on'){
            echo 'คิวรี่ getDetailList รายชื่อตารางในฐานข้อมูล';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query(information_schema,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }
}
?>