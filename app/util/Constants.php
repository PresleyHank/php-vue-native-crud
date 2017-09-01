<?php

namespace Util;

class Constants
{
    /*
     * Pages
     */
    const INDEX_PAGE_LOCATION = '/index.php';
    const LOGIN_PAGE_LOCATION = '/resources/views/loginAndRegistration.php';
    const REGISTRATION_PAGE_LOCATION = '/resources/views/loginAndRegistration.php';
    const LOGOUT_PAGE_LOCATION = '/resources/views/logout.php';

    /*
     * Headers values
     */
    const REDIRECT_TO_INDEX_HEADER = 'Location:/index.php';
    const REDIRECT_TO_ERROR_HEADER = 'Location:/resources/views/errors/error.php';

    /*
     * Registration form error messages
     */
    const ERROR_EMPTY_USERNAME = 'Empty Username field.';
    const ERROR_USERNAME_INCORRECT_SYMBOLS = 'Username contains incorrect symbols.';
    const ERROR_USERNAME_EXISTS = 'Username already exists. Try to choose another one.';

    const ERROR_EMPTY_EMAIL = 'Empty email field.';
    const ERROR_EMPTY_PASSWORD = 'Empty password field.';
    const ERROR_EMPTY_SECONDARY_PASSWORD = 'Empty secondary password field.';

    const ERROR_INCORRECT_EMAIL = 'Email contains incorrect symbols or incorrect.';
    const ERROR_EMAIL_EXISTS = 'Thie email is already taken by other user. Try to choose another one.';
    const ERROR_PASSWORDS_NOT_MATCH = 'Passwords does not match. Check the passwords fields and try again.';
    const ERROR_PASSWORD_IS_TO_SHORT = 'Password is less than 6 symbols. Password must be more than 6 symbols and no longer than 30.';

    const USER_NOT_EXISTS = 'User with such username and password does not exists or password is incorrect. Check your input and try again.';

    const ERROR_CAUSED_NO_INFO = 'WARNING! There is a serious server error occurred! Try again later.';
}