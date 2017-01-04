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
            echo '����� getDetailList �ʴ���¡�õ��ҧ - ������';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }

    function getComment($db='',$tbName=''){
        $result = array();
        $strQuery = "SELECT
                        
                        information_schema.`TABLES`.TABLE_COMMENT AS tb_comment
                        FROM
                        information_schema.`TABLES`
                        WHERE
                        `TABLES`.TABLE_COMMENT != ''
                        AND `TABLES`.TABLE_NAME = '{$tbName}'
                        AND `TABLES`.TABLE_SCHEMA != '{$db}'
                    ";
        if($_GET['debug']=='on'){
            echo '����� getComment �ʴ���¡�õ��ҧ����դ�����';
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
            echo '����� getCountTable �ʴ��ӹǹ���ҧ������/���ҧ����դ�����/���ҧ�������դ�����';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }
        $resultQuery = mysql_db_query($db,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
        $result[] = $row;
        return $result;
    }

    function getDetailFieldList($db='',$table='',$listby=''){
        $result = array();

        if ($listby == 'list_comment'){
            $wherefieldlist = "AND `COLUMNS`.COLUMN_COMMENT != ''";
        }elseif ($listby == 'list_nocomment'){
            $wherefieldlist = "AND `COLUMNS`.COLUMN_COMMENT = ''";
        }else{
            $wherefieldlist = "";
        }

        $strQuery = "SELECT
                        information_schema.`COLUMNS`.TABLE_SCHEMA AS db_name,
                        information_schema.`COLUMNS`.TABLE_NAME AS tb_name,
                        information_schema.`COLUMNS`.COLUMN_NAME AS col_name,
                        information_schema.`COLUMNS`.COLUMN_TYPE AS col_type,
                        information_schema.`COLUMNS`.COLUMN_KEY AS col_key,
                        information_schema.`COLUMNS`.COLUMN_COMMENT AS col_comment
                      FROM
                        information_schema.`COLUMNS`
                      WHERE
                        `COLUMNS`.TABLE_SCHEMA = '{$db}'
                        AND `COLUMNS`.TABLE_NAME = '{$table}'
                        {$wherefieldlist}

                    ";
        if($_GET['debug']=='on'){
            echo '����� getDetailFieldList �ʴ���¡�ÿ�Ŵ�ҡ���ҧ������͡��';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }

        $resultQuery = mysql_db_query($db,$strQuery);
        while ($row = mysql_fetch_assoc($resultQuery)){
            $result[] = $row;
        }
        return $result;
    }

    function getCountField($db='',$table=''){
        $result = array();
        $strQuery = "SELECT
                        COUNT(information_schema.`COLUMNS`.TABLE_NAME) AS numfieldall,
                        COUNT(IF(information_schema.`COLUMNS`.COLUMN_COMMENT != '',information_schema.`COLUMNS`.TABLE_NAME,NULL)) AS numfieldcomment,
                        COUNT(IF(information_schema.`COLUMNS`.COLUMN_COMMENT = '',information_schema.`COLUMNS`.TABLE_NAME,NULL)) AS numfieldnocomment
                      FROM
                        information_schema.`COLUMNS`
                      WHERE
                        `COLUMNS`.TABLE_SCHEMA = '{$db}'
                        AND `COLUMNS`.TABLE_NAME = '{$table}'
                    ";
        if($_GET['debug']=='on'){
            echo '����� getCountField �ʴ��ӹǹ��Ŵ������/��Ŵ����դ�����/��Ŵ�������դ�����';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }
        $resultQuery = mysql_db_query($db,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
        $result[] = $row;
        return $result;
    }

    function getFieldTitleComment($dbname='',$tbName='',$colName=''){
        $strQuery = "SELECT
                        information_schema.`COLUMNS`.TABLE_SCHEMA AS db_name,
                        information_schema.`COLUMNS`.TABLE_NAME AS tb_name,
                        information_schema.`COLUMNS`.COLUMN_COMMENT AS col_comment
                      FROM
                        information_schema.`COLUMNS`
                      WHERE
                        `COLUMNS`.TABLE_SCHEMA = '{$dbname}'
                        AND `COLUMNS`.TABLE_NAME = '{$tbName}'
                        AND `COLUMNS`.COLUMN_NAME = '{$colName}'

                    ";
        if($_GET['debug']=='on'){
            echo '����� getFieldTitleComment �ʴ������鹷�����͡��';
            echo "<pre>"; print_r($strQuery); echo "</pre>";
        }
        $resultQuery = mysql_db_query($dbname,$strQuery);
        $row = mysql_fetch_assoc($resultQuery);
        $result = $row;
        return $result;
    }

    function getFieldList($db='',$colName=''){
        $result = array();

        $strQuery = "SELECT
                        information_schema.`COLUMNS`.TABLE_SCHEMA AS db_name,
                        information_schema.`COLUMNS`.TABLE_NAME AS tb_name,
                        information_schema.`COLUMNS`.COLUMN_NAME AS col_name,
                        information_schema.`COLUMNS`.COLUMN_TYPE AS col_type,
                        information_schema.`COLUMNS`.COLUMN_KEY AS col_key,
                        information_schema.`COLUMNS`.COLUMN_COMMENT AS col_comment
                      FROM
                        information_schema.`COLUMNS`
                      WHERE
                        `COLUMNS`.COLUMN_COMMENT != '' 
                        AND `COLUMNS`.COLUMN_NAME = '{$colName}'

                    ";
        if($_GET['debug']=='on'){
            echo '����� getFieldList �ʴ���¡�ÿ������դ�����';
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