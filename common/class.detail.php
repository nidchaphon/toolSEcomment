<?php

class detail
{

    function getDetailTablelList($db='',$listby=''){
        $result = array();
//
//        if($listby == 1){
//            $wheretblist = "";
//        }else
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
            echo '����� getDetailList �ʴ���¡�õ��ҧ - ������';
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
            echo '����� getDetailList �ʴ���¡�õ��ҧ����դ�����';
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
            echo '����� getDatabaseList �ʴ���¡�ðҹ������';
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
            echo '����� getTitleComment �ʴ������鹷�����͡��';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }
        $resultQuery = mysql_db_query($db,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
            $result[] = $row;
        return $result;
    }
}
?>