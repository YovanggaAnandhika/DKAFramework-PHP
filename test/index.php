<?php

use yovanggaanandhika\dkaframework\Module\Database\Connector as Connect;
use yovanggaanandhika\dkaframework\Module\Database\CRUD as CRUD;

// Run Code

    $db_config = array(
        'host' => "localhost",
        'user' => "root",
        'password' => "",
        'database' => "test"
    );
    $mConnect = Connect::MariaDB($db_config);
    $Read = CRUD::Read($mConnect, "test", true);
    print_r($Read);




