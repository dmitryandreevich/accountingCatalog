<?php session_start(); ?>
<?php
    require_once __DIR__.'/../core/AccountModule.php';
    if(isset($_POST['logout']))
        \core\AccountModule::logout();
    require_once __DIR__.'/../core/functions.php'; // подключаем файл с доп функциями, для их использования
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ИП Галиев</title>
    <link rel="stylesheet" href="<?= \core\getBootstrapUri() ?>">
    <link rel="stylesheet" href="<?= \core\getStyleSheetUri() ?>">
    <link rel="stylesheet" href="<?= \core\getFontAwesome() ?>">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
</head>
