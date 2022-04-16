<?php

namespace yovanggaanandhika\dkaframework\Module\Database;

use PDO;
use yovanggaanandhika\dkaframework\Interface\Database\CRUD as CRUDInterface;

class CRUD extends PDO implements CRUDInterface {

    /**
     * @param $Connector PDO
     * @param $table_name string
     * @param $json_format boolean
     * @return array|false|string
     */
    public static function Read($Connector, $table_name, $json_format = false)
    {
        $reformatTableName = strval($table_name);
        $statement = $Connector->prepare("SELECT * FROM ".$reformatTableName);
        $statement->execute();
        $fetch = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($json_format){
            $json = json_encode($fetch);
        }else{
            $json = $fetch;
        }

        return $json;
    }
}
