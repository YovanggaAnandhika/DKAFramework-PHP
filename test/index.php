<?php

require_once("./../vendor/autoload.php");

use yovanggaanandhika\dkaframework\Module\Database\CRUD\Read;
use yovanggaanandhika\dkaframework\Module\Database\CRUD\Create;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB as MariaDB;

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
    $Options->jsonFormat(false);
    $Options->setData([
        "id_siswa" => 1,
        "nama_siswa" => "DHika"
    ]);
    $Create = $CRUD->Create("siswa", $Options);
    //###############
    //$Options = new Read\Options();
    //$Read = $CRUD->Read("mti-bigdata-data-lokasi_provinsi", $Options->limit(1)->jsonFormat(true));
    //##############
    print_r($Create);




