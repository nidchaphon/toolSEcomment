<?php

class detail
{

    function getDetailTablelList($db='',$listby=''){
        $result = array();

        if ($listby == 'list_comment'){
            $wheretblist = "AND `TABLES`.TABLE_COMMENT != ''";
        }elseif ($listby == 'list_nocomment'){
            $wheretblist = "AND `TABLES`.TABLE_COMMENT = ''";
        }else{
            $wheretblist = "";
        }

        $strQuery = "SELECT
                        information_schema.`TABLES`.TABLE_SCHEMA AS db_name,
                        information_schema.`TABLES`.TABLE_NAME AS tb_name,
                        information_schema.`TABLES`.TABLE_COMMENT AS tb_comment
                    FROM
                        information_schema.`TABLES`
                    WHERE
                        `TABLES`.TABLE_SCHEMA = '{$db}'
                        {$wheretblist}
                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getDetailList แสดงรายการตาราง - คอมเม้น';
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
            echo 'คิวรี getDetailList แสดงรายการตารางที่มีคอมเม้น';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }

    function getDatabaseList($db){
        $result = array();
        $strQuery = "SELECT
                        information_schema.`TABLES`.TABLE_SCHEMA AS db_name
                    FROM
                        information_schema.`TABLES`
                    WHERE `TABLES`.TABLE_SCHEMA != '{$db}'
                    GROUP BY `TABLES`.TABLE_SCHEMA
                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getDatabaseList แสดงรายการฐานข้อมูล';
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

    function getCountTable($db=''){
        $result = array();
        $strQuery = "SELECT
                        COUNT(information_schema.`TABLES`.TABLE_NAME) AS numtball,
                        COUNT(IF(information_schema.`TABLES`.TABLE_COMMENT != '',information_schema.`TABLES`.TABLE_NAME,NULL)) AS numtbcomment,
                        COUNT(IF(information_schema.`TABLES`.TABLE_COMMENT = '',information_schema.`TABLES`.TABLE_NAME,NULL)) AS numtbnocomment
                      FROM
                        information_schema.`TABLES`
                      WHERE
                        `TABLES`.TABLE_SCHEMA = '{$db}'
                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getCountTable แสดงจำนวนตารางทั้งหมด/ตารางที่มีคอมเม้น/ตารางที่ไม่มีคอมเม้น';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }
        $resultQuery = mysql_db_query($db,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
        $result[] = $row;
        return $result;
    }

    function getDetailColumnList($db='',$table=''){
        $result = array();
        $strQuery = "SELECT
                        information_schema.`COLUMNS`.TABLE_SCHEMA,
                        information_schema.`COLUMNS`.TABLE_NAME,
                        information_schema.`COLUMNS`.COLUMN_NAME,
                        information_schema.`COLUMNS`.COLUMN_TYPE,
                        information_schema.`COLUMNS`.COLUMN_KEY,
                        information_schema.`COLUMNS`.COLUMN_COMMENT
                      FROM
                        information_schema.`COLUMNS`
                      WHERE
                        `COLUMNS`.TABLE_SCHEMA = '$db'
                        AND `COLUMNS`.TABLE_NAME = '$table'

                    ";
        if($_GET['debug']=='on'){
            echo 'คิวรี getDetailColumnList แสดงรายการคอลัมน์จากตารางที่เลือกมา';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }
}
?>