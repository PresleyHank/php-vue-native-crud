<?php


namespace Util;

use Dao\UserDao;
use Entity\User;

class FormValidator
{
    private const USERNAME_PATTERN = '/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/';

    public static function &validateRegForm(array &$errorList, UserDao $userDao): array
    {
        $email = $_POST['email'];
        $userName = $_POST['username'];
        $password = $_POST['password'];
        $secondaryPassword = $_POST['secondaryPassword'];
        if (!isset($userName) || $userName === "") {
            array_push($errorList, Constants::ERROR_EMPTY_USERNAME);
        } else if (preg_match(self::USERNAME_PATTERN, $userName)) {
            array_push($errorList, Constants::ERROR_USERNAME_INCORRECT_SYMBOLS);
        } else if ($userDao->isUserNameExists($userName)) {
            array_push($errorList, Constants::ERROR_USERNAME_EXISTS);
        }
        if (!isset($password)) {
            array_push($errorList, Constants::ERROR_EMPTY_PASSWORD);
        } else if (!isset($secondaryPassword)) {
            array_push($errorList, Constants::ERROR_EMPTY_SECONDARY_PASSWORD);
        } else if (strcmp($password, $secondaryPassword)) {
            array_push($errorList, Constants::ERROR_PASSWORDS_NOT_MATCH);
        }
        if (!isset($email)) {
            array_push($errorList, Constants::ERROR_EMPTY_EMAIL);
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errorList, Constants::ERROR_INCORRECT_EMAIL);
        } else if ($userDao->isEmailExists($email)) {
            array_push($errorList, Constants::ERROR_EMAIL_EXISTS);
        }
        return $errorList;
    }

    public static function &validateLogin(array &$errorList, UserDao &$userDao): ?User
    {
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $password = $_POST['password'];
        if (!isset($usernameOrEmail)) {
            array_push($errorList, Constants::ERROR_EMPTY_USERNAME);
        }
        if (!isset($password)) {
            array_push($errorList, Constants::ERROR_EMPTY_PASSWORD);
        }
        $user = $userDao->getByLoginOrEmail($_POST['usernameOrEmail'], $_POST['password']);
        if ($user === null) {
            array_push($errorList, Constants::USER_NOT_EXISTS);
        }
        return $user;
    }

    public static function &validateGroup(array &$errorList): array
    {
        $id_user = $_POST['id_user'];
        $title = $_POST['title'];
        $imageLink = $_POST['imageLink'];
        if (!isset($id_user)) {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_IS_NOT_SET);
        } elseif ($id_user === "") {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_IS_EMPTY);
        } elseif (!is_numeric($id_user)) {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_NOT_A_NUMBER);
        }
        if (!isset($title) || $title === "") {
            array_push($errorList, Constants::ERROR_GROUP_TITLE_EMPTY);
        }
        if (!isset($imageLink) || $imageLink === "") {
            array_push($errorList, Constants::ERROR_GROUP_IMAGE_LINK);
        }
        return $errorList;
    }

    public static function validateGroupDeletion(array &$errorList)
    {
        $groupID = $_POST['id'];
        $sessionUserId = $_POST['id_user'];
        if (!isset($sessionUserId)) {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_IS_NOT_SET);
        } elseif ($sessionUserId === "") {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_IS_EMPTY);
        } elseif (!is_numeric($sessionUserId)) {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_NOT_A_NUMBER);
        }
        if (!isset($groupID) || $groupID === "") {
            array_push($errorList, Constants::ERROR_GROUP_USER_ID_IS_NOT_SET);

        } elseif (is_numeric($groupID)) {
            array_push($errorList, Constants::ERROR_GROUP_ID_NOT_A_NUMBER);
        }
        return $errorList;
    }
}