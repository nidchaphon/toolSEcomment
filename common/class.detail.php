<?php

class detail
{
    function getDetailList(){
        $result = array();
        $strQuery = "
            SELECT
                *
            FROM
              information_schema
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