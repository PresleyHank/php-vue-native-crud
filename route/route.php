<?php

namespace Route;

use Util\Constants;

require_once('../app/util/reflect.php');
require_once('../vendor/autoload.php');
require_once('../app/util/views.php');

session_start();
if ($_GET) {
    if (isset($_SESSION['user']) && in_array($_GET["route"], $excludesForLoggedIn)) {
        header(Constants::REDIRECT_TO_INDEX_HEADER);
        die();
    }
    if (isset($_GET["route"]) && array_key_exists($_GET["route"], $pages)) {
        header('Location:' . $pages[$_GET["route"]]);
        die();
    } else {
        errorPageNotFound();
    }
} elseif ($_POST) {
    if (isset($_SESSION['user'])) {
        header(Constants::REDIRECT_TO_INDEX_HEADER);
        die();
    }
    $action = $_POST['action'];
    if (isset($action) && array_key_exists($action, $actions)) {
        call_user_func($actions[$action]);
    } else {
        errorPageNotFound();
    }
} else {
    errorPageNotFound();
}

function errorPageNotFound()
{
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Произошла неизвестная ошибка, попробуйте позднее.'));
    die();
}

