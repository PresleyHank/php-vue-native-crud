<?php
session_start();
if (isset($_SESSION['errorList'])) {
    echo '<b>Errors occurred during a form input operation:</b>';
    echo '<ul>';
    foreach ($_SESSION['errorList'] as $value) {
        echo '<li>' . $value . '</li>';
    }
    echo '</ul>';
    unset($_SESSION['errorList']);
}
?>