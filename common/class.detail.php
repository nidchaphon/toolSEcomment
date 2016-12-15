<?php

class detail
{
    function getDetailList($id){
        $result = array();
        $strQuery = "
            SELECT
                information_schema.`TABLES`.TABLE_SCHEMA,
                information_schema.`TABLES`.TABLE_NAME,
                information_schema.`TABLES`.TABLE_COMMENT
            FROM
              information_schema.`TABLES`
            ORDER BY `TABLES`.TABLE_NAME
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