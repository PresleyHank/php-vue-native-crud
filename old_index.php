<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Sign-Up & Login Form</title>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="resources/assets/css/style.css">
</head>
<body>
<div class="form">
    <?php
    session_start();
    if (isset($_SESSION['user'])) {
        @include_once('resources/views/logged.php');
    } else {
        @include_once('resources/views/loginAndRegistration.php');
    }
    ?>
</div>
<script src='https://code.jquery.com/jquery-3.1.1.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="resources/assets/js/index.js"></script>
<script src="resources/assets/js/validator.js"></script>
</body>
</html>
