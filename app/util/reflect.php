<?php
$getActions = array(
    'login' => 'Controller\LoginController::getLogin',
    'registration' => 'Controller\RegistrationController::getRegistration',
    'listAllGroups' => 'Controller\GroupController::listAllGroups',
    'logout' => 'Controller\LoginController::logout'
);

$postActions = array(
    'login' => 'Controller\LoginController::postLogin',
    'registration' => 'Controller\RegistrationController::postRegistration',
    'replaceGroup' => 'Controller\GroupController::replaceGroup',
    'saveGroup' => 'Controller\GroupController::saveGroup'
);