<?php

namespace yovanggaanandhika\dkaframework\Interface\Database;
use PDO;
interface CRUD {

    /**
     * @param $Connector PDO
     * @param $table_name String
     */
    public static function Read($Connector, $table_name, $json_format = false);
}