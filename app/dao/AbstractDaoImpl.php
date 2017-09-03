<?php

namespace Dao;

use PDO;

abstract class AbstractDaoImpl implements AbstractDao
{
    private static $connection = null;
    private $dbName = 'php_vuejs2_native_crud';
    private $dbHost = 'localhost';
    private $dbUsername = 'root';
    private $dbUserPassword = '111111';
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    public function connect(): PDO
    {
        $this->connection = new PDO("mysql:host=" . $this->dbHost . ";" . "dbname=" . $this->dbName,
            $this->dbUsername,
            $this->dbUserPassword,
            $this->options);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->connection;
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}