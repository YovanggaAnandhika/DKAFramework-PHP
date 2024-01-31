<?php

require_once("./../vendor/autoload.php");

use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Create;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Read;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\MariaDB as MariaDB;

// Run Code
    $db_config = array(
        'host' => "localhost",
        'user' => "developer",
        'password' => "Cyberhack2010",
        'database' => "test"
    );
    $MariaDB = new MariaDB($db_config);
    $CRUD = $MariaDB->CRUD();

    $Options = new Create\Options();
    $Options->jsonFormat(true);
    $Options->setData([
        "nama_siswa" => "DHika"
    ]);
    $Create = $CRUD->Create("siswa", $Options);
    //###############
    $Options = new Read\Options();
    $Read = $CRUD->Read("siswa", $Options->limit(1)->jsonFormat(true));
    //##############
    header('Content-Type: application/json');
    echo $Read;




