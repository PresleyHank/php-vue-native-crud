<?php
$pages = array(
    'login' => \Util\Constants::LOGIN_PAGE_LOCATION,
    'registration' => \Util\Constants::REGISTRATION_PAGE_LOCATION,
    'index' => \Util\Constants::INDEX_PAGE_LOCATION,
    'logout' => \Util\Constants::LOGOUT_PAGE_LOCATION
);

/*
 * Pages that aren't accessible for logged users.
 */
$excludesForLoggedIn = array(
    'login',
    'registration'
);

$excludesForLoggedOut = array(
    'replaceGroup',
    'saveGroup',
    'logout'
);