<?php

namespace yovanggaanandhika\dkaframework\Interface\Database;

use PDO;

interface Connector {

    /**
     * @param $configuration array[]
     * @param $pdo_default_fetchmode
     * @param $error_mode
     * @return PDO;
     */
    public static function MariaDB($configuration, $pdo_default_fetchmode = PDO::FETCH_ASSOC, $error_mode = PDO::ERRMODE_SILENT): PDO;

}