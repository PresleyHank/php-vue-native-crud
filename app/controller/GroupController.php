<?php

namespace Controller;

use Dao\GroupDaoImpl;
use Entity\Group;
use Util\Constants;
use Util\FormValidator;

class GroupController
{
    public static function saveGroup()
    {
        $errorList = array();
        $errorList = FormValidator::validateGroup($errorList);
        if (!empty($errorList)) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => json_encode(array_values($errorList))));
        } else {
            $groupDao = New GroupDaoImpl();
            $group = New Group();
            if (isset($_POST['id']) && $_POST['id'] !== "") {
                $group->setId($_POST['id']);
            }
            $group->setUserId($_POST['id_user']);
            $group->setTitle($_POST['title']);
            $group->setImageLink($_POST['imageLink']);
            $groupDao->save($group) > 0 ? self::successInfo(Constants::SUCCESS_GROUP_SAVED)
                : self::errorInfo(Constants::ERROR_GROUP_SAVE);
        }
    }

    public static function successInfo(string $successMessage = "1")
    {
        header('Content-Type: application/json');
        echo json_encode(array('success' => json_encode(array($successMessage))));
        die();
    }

    public static function errorInfo(string $errorMessage)
    {
        header('Content-Type: application/json');
        echo json_encode(array('error' => json_encode(array($errorMessage))));
        die();
    }

    public static function replaceGroup()
    {
        $errorList = array();
        $errorList = FormValidator::validateGroup($errorList);
        if (!empty($errorList)) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => json_encode(array_values($errorList))));
        } else {
            $groupDao = New GroupDaoImpl();
            if ($groupDao->delete($_POST['id'])) {
                self::successInfo(Constants::SUCCESS_GROUP_IS_DELETED);
            } else {
                self::errorInfo(Constants::ERROR_GROUP_SAVE);
            };
        }
    }

    public static function listAllGroups()
    {
        $groupDao = New GroupDaoImpl();
        header('Content-Type: application/json;charset=utf-8');
        echo $groupDao->listAll();
    }
}