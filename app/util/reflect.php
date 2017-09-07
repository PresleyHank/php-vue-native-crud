<?php
$getActions = array(
    'listAllGroups' => 'Controller\GroupController::listAllGroups'
);

$postActions = array(
    'logout' => 'Controller\LoginController::logout',
    'login' => 'Controller\LoginController::postLogin',
    'registration' => 'Controller\RegistrationController::postRegistration',
    'replaceGroup' => 'Controller\GroupController::replaceGroup',
    'saveGroup' => 'Controller\GroupController::saveGroup'
);