<?php

namespace Dao;

use PDO;
use Util\Constants;

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

    public function errorTrackingInfo(string $errorMessage = Constants::ERROR_CAUSED)
    {
        header('Content-Type: application/json');
        echo json_encode(array('error' => $errorMessage));
        die();
    }

    public function successInfo(string $successMessage = "1")
    {
        header('Content-Type: application/json');
        echo json_encode(array('success' => $successMessage));
        die();
    }
}