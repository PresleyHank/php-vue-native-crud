<?php

namespace Controller;

use Dao\UserDaoImpl;
use Util\FormValidator;


class LoginController
{
    public static function postLogin()
    {
        session_start();
        $userDao = New UserDaoImpl();
        $errorList = array();
        $user = FormValidator::validateLogin($errorList, $userDao);
        if (!empty($errorList)) {
            $_SESSION['errorList'] = $errorList;
            echo json_encode(array('error' => json_encode(array_values($errorList))));
        } else {
            $_SESSION['user'] = $user->getId();
            echo json_encode(array('userId' => $user->getId()));
        }
    }

    public static function logout()
    {
        session_start();
        $errorList = array();
        $errorList = FormValidator::validateLogOut($errorList);
        if (!empty($errorList)) {
            $_SESSION['errorList'] = $errorList;
            echo json_encode(array('error' => json_encode(array_values($errorList))));
        } else {
            session_destroy();
            echo json_encode(array('success' => "Success session logout."));
        }
    }
}

