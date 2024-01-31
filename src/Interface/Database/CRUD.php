<?php

namespace yovanggaanandhika\dkaframework\Interface\Database;
use PDO;
interface CRUD {

    /**
     * @param $table_name String
     */
    public function Read($table_name, $options = array('json_format' => false));
}