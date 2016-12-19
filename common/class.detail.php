<?php

class detail
{
    function getDetailList($db){
        $result = array();
        $strQuery = "SELECT
                        information_schema.`TABLES`.TABLE_SCHEMA AS db_name,
                        information_schema.`TABLES`.TABLE_NAME AS tb_name,
                        information_schema.`TABLES`.TABLE_COMMENT AS tb_comment
                    FROM
                        information_schema.`TABLES`
                    WHERE
                        `TABLES`.TABLE_SCHEMA = '{$db}'
                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getDetailList แสดงรายการตารางที่ไม่มีคอมเม้น';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }

    function getTableList($db='',$table=''){
        $result = array();
        $strQuery = "SELECT
                        information_schema.`TABLES`.TABLE_SCHEMA AS db_name,
                        information_schema.`TABLES`.TABLE_NAME AS tb_name,
                        information_schema.`TABLES`.TABLE_COMMENT AS tb_comment
                        FROM
                        information_schema.`TABLES`
                        WHERE
                        `TABLES`.TABLE_COMMENT != ''
                        AND `TABLES`.TABLE_NAME = '{$table}'
                      

                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getDetailList แสดงรายการตารางที่ไม่มีคอมเม้น';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }

    function getTitleComment($db='',$database='',$table=''){
        $result = array();
        $strQuery = "SELECT
                        information_schema.`TABLES`.TABLE_SCHEMA AS db_name,
                        information_schema.`TABLES`.TABLE_NAME AS tb_name,
                        information_schema.`TABLES`.TABLE_COMMENT AS tb_comment
                        FROM
                        information_schema.`TABLES`
                        WHERE
                        `TABLES`.TABLE_COMMENT != ''
                        AND `TABLES`.TABLE_SCHEMA = '{$database}'
                        AND `TABLES`.TABLE_NAME = '{$table}'

                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getTitleComment แสดงคอมเม้นที่เลือกมา';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
            $result[] = $row;
        return $result;
    }
}
?>