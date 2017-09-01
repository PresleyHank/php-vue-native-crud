<?php

namespace Dao;


use PDO;

interface AbstractDao
{
    function connect(): PDO;

    function disconnect();
}