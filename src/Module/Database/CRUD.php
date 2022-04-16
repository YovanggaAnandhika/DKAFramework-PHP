<?php

namespace yovanggaanandhika\dkaframework\Module\Database;

use PDO;
use yovanggaanandhika\dkaframework\Interface\Database\CRUD as CRUDInterface;

class CRUD extends PDO implements CRUDInterface {

    public static function Read($Connector, $table_name)
    {
        $reformatTableName = strval($table_name);
        $statement = $Connector->prepare("SELECT * FROM :table_name");
        $statement->bindParam(":table_name", $reformatTableName);
        $statement->execute();
        $fetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($fetch);

        return $json;
    }
}
