<?php

namespace Controller;

use Dao\UserDaoImpl;
use Entity\User;
use Util\Constants;
use Util\FormValidator;


class RegistrationController
{
    public static function postRegistration()
    {
        session_start();
        $errorList = array();
        $userDao = New UserDaoImpl();
        $errorList = FormValidator::validateRegForm($errorList, $userDao);
        if (!empty($errorList)) {
            echo json_encode(array('error' => json_encode(array_values($errorList))));
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
                echo json_encode(array('userId' => $userId));
            } else {
                array_push($errorList, Constants::ERROR_CAUSED_NO_INFO);
                echo json_encode(array('error' => json_encode(array_values($errorList))));
            }
        }
    }
}


