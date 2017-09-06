<?php

namespace Controller;

use Dao\UserDaoImpl;
use Util\Constants;
use Util\FormValidator;


class LoginController
{
    public static function getLogin()
    {
        header('Location: ' . Constants::LOGIN_PAGE_LOCATION);
        die();
    }

    public static function postLogin()
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
    }

    public static function logout()
    {
        session_start();
        if ($_SESSION['user']) {
            session_destroy();
            header('Location: /index.php');
        }
    }
}

