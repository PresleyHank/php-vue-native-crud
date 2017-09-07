<?php

namespace Route;

use Util\Constants;

require_once('../vendor/autoload.php');
require_once('../app/util/reflect.php');
require_once('../app/util/views.php');

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (isset($_SESSION['user']) && in_array($action, $excludesForLoggedIn)) {
        header(Constants::REDIRECT_TO_INDEX_HEADER);
        die();
    }
    if (array_key_exists($action, $getActions)) {
        call_user_func($getActions[$action]);
    } else {
        errorOccurs(Constants::ERROR_GET_PATH_NOT_FOUND);
    }
} elseif (isset($_POST['action'])) {
    if (!isset($_SESSION['user'])) {
        errorOccurs(Constants::USER_IS_ALREADY_IN_SESSION);
    }
    $action = $_POST['action'];
    if (array_key_exists($action, $postActions)) {
        call_user_func($postActions[$action]);
    } else {
        errorOccurs(Constants::ERROR_POSTING_DATA);
    }
} else {
    errorOccurs();
}

function errorOccurs(string $errorMessage = Constants::ERROR_CAUSED)
{
    header('Content-Type: application/json');
    echo json_encode(array('error' => json_encode(array($errorMessage))));
    die();
}

