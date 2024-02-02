<?php

require_once "./../vendor/autoload.php";

use dkaframework\core\Module\Database\MariaDB\MariaDB;
use dkaframework\core\Module\Database\MariaDB\CRUD\Read;
use dkaframework\core\Module\Database\MariaDB\CRUD\Delete;

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
    $Options = new Delete\Options();
    $Options
        ->jsonFormat(true)
        ->addSearch(array(
            "id_siswa" => 2
        ));
    $Read = $CRUD->Delete("siswa", $Options);
    //##############
    header('Content-Type: application/json');
    echo $Read;




