<?php

namespace Route;

use Util\Constants;

require_once('../vendor/autoload.php');
require_once('../app/util/reflect.php');
require_once('../app/util/views.php');

session_start();
if ($_GET) {
    $action = $_GET['action'];
    if (isset($_SESSION['user']) && in_array($action, $excludesForLoggedIn)) {
        header(Constants::REDIRECT_TO_INDEX_HEADER);
        die();
    }
    if (isset($action) && array_key_exists($action, $getActions)) {
        call_user_func($getActions[$action]);
    } else {
        errorPageNotFound();
    }
} elseif ($_POST) {
    if (!isset($_SESSION['user'])) {
        header(Constants::REDIRECT_TO_INDEX_HEADER);
        die();
    }
    $action = $_POST['action'];
    if (isset($action) && array_key_exists($action, $postActions)) {
        call_user_func($postActions[$action]);
    } else {
        errorPageNotFound();
    }
} else {
    errorPageNotFound();
}

function errorPageNotFound(string $errorMessage = Constants::ERROR_CAUSED)
{
    header('Content-Type: application/json');
    echo json_encode(array('error' => $errorMessage));
    die();
}

