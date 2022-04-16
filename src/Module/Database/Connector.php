<?php

namespace yovanggaanandhika\dkaframework\Module\Database;

use PDO;
use yovanggaanandhika\dkaframework\Interface\Database\Connector as Interfaces;

class Connector extends PDO implements Interfaces {

    /**
     * @param $configuration array configuration array connection
     * @param $database string name of Database
     * @param $pdo_default_fetchmode int the fecth mode options
     * @param $error_mode int error mode options
     * @return PDO
     */
    public static function MariaDB($configuration, $database = "test", $pdo_default_fetchmode = PDO::FETCH_ASSOC, $error_mode = PDO::ERRMODE_SILENT) : PDO{
        /** ==============================
         * Mapping variable $Connector :
         * ---------------------------- */

        $db_user = $configuration['user'];
        $db_pass = $configuration['password'];
        $db_host = $configuration['host'];
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE            => $error_mode, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => $pdo_default_fetchmode, //make the default fetch be an associative array
        ];
        /** =============================================
         * Placing Open Object into variable $connect :
         * -------------------------------------------- */
        $toString = strval($database);
        $dsn = 'mysql:host=' . $db_host . ';dbname=' .$toString;
        $connect = new PDO($dsn, $db_user,$db_pass, $options);

        /** ==============
         * Return Data :
         * ------------- */
        return $connect;
    }

}