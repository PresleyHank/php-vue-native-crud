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

    const ERROR_USER_IS_NOT_IN_SESSION = "You can not logout because you are not in the session already.";
    const ERROR_VUE_SESSION_ID_NOT_SET = "Vue session id is not set!";
    const ERROR_VUE_SESSION_NOT_EQUAL_TO_CURRENT = "Vue session id is not equal to current server session. Access denied!";

    const ERROR_CAUSED_NO_INFO = 'WARNING! There is a serious server error occurred! Try again later.';

    const ERROR_CAUSED = 'Unknown error occurs! Try again later.';
    const USER_IS_NOT_IN_SESSION = 'You must to login to have rights to edit table data information.';
    const ERROR_GET_PATH_NOT_FOUND = 'There is no path that you have selected. Try to choose other location.';
    const ERROR_POSTING_DATA = 'Information is not saved. Try again later.';

    /*
     * Group validation messages
     */
    const ERROR_GROUP_USER_ID_IS_NOT_SET = "Group user's session id is not set.";
    const ERROR_GROUP_USER_ID_IS_EMPTY = "Group nuser's session id is an empty string";
    const ERROR_GROUP_USER_ID_NOT_A_NUMBER = 'Group user id is not a number';
    const ERROR_GROUP_USER_ID_NOT_EQUALS_TO_OWNER = 'Group user id is not equal to owner. You are trying to modify the group of not your own.';
    const ERROR_GROUP_ID_NOT_A_NUMBER = "Group id is not a number.";
    const ERROR_GROUP_TITLE_EMPTY = 'Group title is empty or not set.';
    const ERROR_GROUP_IMAGE_LINK = 'Group image link es empty or not set.';

    /*
     * Group dao exception messages
     */
    const ERROR_GROUP_SAVE = 'Group savings error occurs.';
    const ERROR_GROUP_GET = 'Cannot save group. Something does wrong with database.';
    const ERROR_GROUP_DELETE = 'Group delete is impossible. Some error occurs in the database.';
    const ERROR_GROUP_LIST_ALL = 'Cannot get a list of all groups. Some error occurs in the database.';
    const ERROR_GROUP_LIST_ALL_BY_USER = 'Cannot get a list of groups by user. Some error occurs in the database.';

    const SUCCESS_GROUP_SAVED = 'Success! Group is saved.';
    const SUCCESS_GROUP_IS_DELETED = 'Success! Group was deleted.';
}