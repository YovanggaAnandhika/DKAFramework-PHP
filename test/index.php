<?php

require_once "./../vendor/autoload.php";

use yovanggaanandhika\dkaframework\Module\Database\MariaDB\MariaDB;
use yovanggaanandhika\dkaframework\Module\Database\MariaDB\CRUD\Update;

// Run Code
    $db_config = array(
        'host' => "localhost",
        'user' => "developer",
        'password' => "Cyberhack2010",
        'database' => "test"
    );
    $MariaDB = new MariaDB($db_config);
    $CRUD = $MariaDB->CRUD();
    //###############
    $Options = new Update\Options();
    $Options->setData(array(
        "nama_siswa" => "Dhika"
    ))->addSearch(array(
        "id_siswa" => 1,
        "AND",
        "nama_siswa" => "Dhika"
    ))->jsonFormat(true);
    $Read = $CRUD->Update("siswa", $Options);
    //##############
    header('Content-Type: application/json');
    echo $Read;




