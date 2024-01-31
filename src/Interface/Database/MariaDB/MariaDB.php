<?php

namespace yovanggaanandhika\dkaframework\Interface\Database\MariaDB;

use PDO;

interface MariaDB {

    /**
     * @param $configuration array[]
     * @param int $pdo_default_fetchmode
     * @param int $error_mode
     */
    public function __construct($configuration, $pdo_default_fetchmode = PDO::FETCH_ASSOC, $error_mode = PDO::ERRMODE_SILENT);

}