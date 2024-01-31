<?php

require_once("./../vendor/autoload.php");

use yovanggaanandhika\dkaframework\Module\Database\CRUD\Read\OptionsRead as Options;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB as MariaDB;

// Run Code
    $db_config = array(
        'host' => "localhost",
        'user' => "developer",
        'password' => "Cyberhack2010",
        'database' => "dka"
    );
    $MariaDB = new MariaDB($db_config);
    $CRUD = $MariaDB->CRUD();
    $Options = new Options();
    $Read = $CRUD->Read("mti-bigdata-data-lokasi_provinsi", $Options->limit(1)->jsonFormat(true));
    print_r($Read);




