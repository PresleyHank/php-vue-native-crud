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
}