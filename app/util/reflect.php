<?php
$getActions = array(
    'login' => 'Controller\LoginController::getLogin',
    'registration' => 'Controller\RegistrationController::getRegistration',
    'listAllGroups' => 'Controller\GroupController::listAllGroups',
    'logout' => 'Controller\LoginController::logout'
);

$postActions = array(
    'login' => 'LoginController::postLogin',
    'registration' => 'RegistrationController::postRegistration',
    'addGroup' => 'GroupController::addGroup',
    'replaceGroup' => 'GroupController::replaceGroup',
    'saveGroup' => 'GroupController::updateGroup',
);