<?php

namespace Controller;

use Dao\GroupDaoImpl;

class GroupController
{
    public static function addGroup()
    {

    }

    public static function replaceGroup()
    {

    }

    public static function updateGroup()
    {

    }

    public static function listAllGroups()
    {
        session_start();
        $groupDao = New GroupDaoImpl();
        header('Content-Type: application/json;charset=utf-8');
        echo $groupDao->listAll();
    }
}