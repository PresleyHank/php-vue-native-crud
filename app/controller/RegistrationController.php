<?php

namespace Controller;

use Dao\UserDaoImpl;
use Entity\User;
use Util\Constants;
use Util\FormValidator;


class RegistrationController
{
    public static function getRegistration()
    {
        header('Location: ' . Constants::REGISTRATION_PAGE_LOCATION);
        die();
    }

    public static function postRegistration()
    {
        session_start();
        $errorList = array();
        $userDao = New UserDaoImpl();
        $errorList = FormValidator::validateRegForm($errorList, $userDao);
        if (!empty($errorList)) {
            $_SESSION['errorList'] = $errorList;
            header(Constants::REDIRECT_TO_INDEX_HEADER);
        } else {
            $user = New User();
            $user->setUserName($_POST['username']);
            $user->setPassword($_POST['password']);
            $user->setEmail($_POST['email']);
            $user->setActive(true);
            $userId = $userDao->save($user);
            if ($userId > 0) {
                session_start();
                $_SESSION['user'] = $userId;
                header(Constants::REDIRECT_TO_INDEX_HEADER);
            } else {
                $errorList[] = Constants::ERROR_CAUSED_NO_INFO;
                $_SESSION['errorList'] = $errorList;
                header(Constants::REDIRECT_TO_INDEX_HEADER);
            }
        }
    }
}


