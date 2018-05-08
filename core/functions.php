<?php
// файл с дополнительными функциями
    namespace core;

    // получить адрес для стилей из любого файла
    function getStyleSheetUri(){
        return 'http://'.$_SERVER['HTTP_HOST'].'/css/style.css';
    }
    // получить адрес для библиотеки бутстрап из любого файла
    function getBootstrapUri(){
        return 'http://'.$_SERVER['HTTP_HOST'].'/css/bootstrap.min.css';
    }
    // подключить шапку
    function includeHeader(){
        include __DIR__.'/../layouts/header.php';
    }
    // подключить подвал (футер)
    function includeFooter(){
        include __DIR__.'/../layouts/footer.php';
    }
    // подключить head блок
    function includeHead(){
        require_once __DIR__.'/../core/functions.php';
        include __DIR__.'/../layouts/head.php';
    }
    // получить адрес для css font awesome с стилями для иконок
    function getFontAwesome(){
        return 'http://'.$_SERVER['HTTP_HOST'].'/css/fontawesome-all.css';
    }