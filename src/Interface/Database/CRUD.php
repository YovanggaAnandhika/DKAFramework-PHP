<?php

namespace yovanggaanandhika\dkaframework\Interface\Database;
use yovanggaanandhika\dkaframework\Module\Database\CRUD\Create;
use yovanggaanandhika\dkaframework\Module\Database\CRUD\Read;

interface CRUD {

    /**
     * @param $table_name String
     * @param Create\Options $options
     */
    public function Create(string $table_name, Create\Options $options);

    /**
     * @param $table_name String
     * @param Read\Options $options
     */
    public function Read(string $table_name, Read\Options $options = new Read\Options());
}