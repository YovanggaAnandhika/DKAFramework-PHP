<?php

namespace yovanggaanandhika\dkaframework\Interface\Database;
use http\QueryString;
use PDO;
interface CRUD {

    /**
     * @param $Connector PDO
     * @param $table_name QueryString
     */
    public static function Read($Connector, $table_name) ;
}