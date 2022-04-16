<?php

namespace yovanggaanandhika\dkaframework\Interface;

use PDO;

interface Database {

    public static function MariaDB($configuration, $db_name = 'test', $pdo_default_fetchmode = PDO::FETCH_ASSOC, $error_mode = PDO::ERRMODE_SILENT);

}