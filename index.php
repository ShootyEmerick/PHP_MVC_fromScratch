<?php

session_start();

define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core();
$app->run();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PiePHP</title>
</head>
<body>
<pre>
<!--    --><?php
//        var_dump("POST", $_POST);
//        var_dump("GET", $_GET);
//        var_dump("SERVER", $_SERVER);
//        var_dump("SESSION", $_SESSION);
//    ?>
</pre>
</body>
</html>