<?php

namespace Controller;

use Dao\UserDaoImpl;
use Util\Constants;
use Util\FormValidator;


class LoginController
{
    public static function login()
    {
        session_start();
        $userDao = New UserDaoImpl();
        $errorList = array();
        $user = FormValidator::validateLogin($errorList, $userDao);
        if (!empty($errorList)) {
            $_SESSION['errorList'] = $errorList;
            header(Constants::REDIRECT_TO_INDEX_HEADER);
        } else {
            $_SESSION['user'] = $user->getId();
            header(Constants::REDIRECT_TO_INDEX_HEADER);
        }
        exit;
    }
}

