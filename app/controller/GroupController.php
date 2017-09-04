<?php

namespace Controller;

use Dao\GroupDaoImpl;

class GroupController
{
    public static function addGroup()
    {
        $id_user = $_POST['id_user'];
        $title = $_POST['title'];
        $imageLink = $_POST['imageLink'];
        echo $id_user . ' ' . $title . ' ' . $imageLink;
        die();
    }

    public static function replaceGroup()
    {

    }

    public static function updateGroup()
    {

    }

    public static function listAllGroups()
    {
        $groupDao = New GroupDaoImpl();
        header('Content-Type: application/json;charset=utf-8');
        echo $groupDao->listAll();
    }
}