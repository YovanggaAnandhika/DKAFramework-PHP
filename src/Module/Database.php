<?php

namespace yovanggaanandhika\dkaframework\Module;

use yovanggaanandhika\dkaframework\Interface\Database as Interfaces;
use PDO;

class Database extends PDO implements Interfaces {

    public static function MariaDB($configuration, $db_name = 'test', $pdo_default_fetchmode = PDO::FETCH_ASSOC, $error_mode = PDO::ERRMODE_SILENT) : PDO{
        /** ==============================
         * Mapping variable $Database :
         * ---------------------------- */

        $db_user = $configuration['db_config']['db_user'];
        $db_pass = $configuration['db_config']['db_pass'];
        $db_host = $configuration['db_config']['db_host'];
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE            => $error_mode, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => $pdo_default_fetchmode, //make the default fetch be an associative array
        ];
        /** =============================================
         * Placing Open Object into variable $connect :
         * -------------------------------------------- */
        $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
        $connect = new PDO($dsn, $db_user,$db_pass, $options);

        /** ==============
         * Return Data :
         * ------------- */
        return $connect;
    }

}