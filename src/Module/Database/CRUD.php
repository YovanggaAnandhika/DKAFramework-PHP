<?php
require ("./../../../vendor/autoload.php");
use yovanggaanandhika\dkaframework\Interface\Database\CRUD as CRUDInterface;

class CRUD implements CRUDInterface {


    public static function Read($Connector, $table_name)
    {
        $reformatTableName = strval($table_name);
        $statement = $Connector->prepare("SELECT :array FROM :table_name");
        $statement->bindParam(":table_name",$reformatTableName);
        $statement->bindParam(":array", $str);
        $fetch = $statement->fetchAll(PDO::FETCH_COLUMN);
        $count = $statement->rowCount();
        $json = json_encode($fetch);

        return $json;
    }
}
