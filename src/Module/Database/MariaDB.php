<?php

namespace yovanggaanandhika\dkaframework\Module\Database;

use PDO;
use yovanggaanandhika\dkaframework\Module\Database\CRUD\CRUD as CRUD;

class MariaDB{

    private static PDO $Connector;

    private function getConnector(): PDO
    {
        return self::$Connector;
    }
    /**
     * @param mixed $Connector
     */
    private function setConnector(PDO $Connector): void
    {
        self::$Connector = $Connector;
    }

    /**
     * @param $configuration array configuration array connection
     * @param $pdo_default_fetchmode int the fetch mode options
     * @param $error_mode int error mode options
     */
    public function __construct(array $configuration, int $pdo_default_fetchmode = PDO::FETCH_ASSOC, int $error_mode = PDO::ERRMODE_SILENT)
    {
        /** ==============================
         * Mapping variable $Connector :
         * ---------------------------- */

        $db_user = $configuration['user'];
        $db_pass = $configuration['password'];
        $db_host = $configuration['host'];
        $db_name = $configuration['database'];
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE            => $error_mode, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => $pdo_default_fetchmode, //make the default fetch be an associative array
        ];
        /** =============================================
         * Placing Open Object into variable $connect :
         * -------------------------------------------- */
        $toString = strval($db_name);
        $dsn = 'mysql:host=' . $db_host . ';dbname=' .$toString;
        /** ==============
         * Return Data :
         * ------------- */
        $pdo = new PDO($dsn, $db_user,$db_pass, $options);
        $this->setConnector($pdo);
    }

    /**
     * @return \yovanggaanandhika\dkaframework\Module\Database\CRUD\CRUD
     */
    public function CRUD() : CRUD {
        return new CRUD($this->getConnector());
    }

}