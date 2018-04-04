<?php
    namespace core;


    function getStyleSheetUri(){
        return 'http://'.$_SERVER['HTTP_HOST'].'/css/style.css';
    }
    function getBootstrapUri(){
        return 'http://'.$_SERVER['HTTP_HOST'].'/css/bootstrap.min.css';
    }
    function includeHeader(){
        include __DIR__.'/../layouts/header.php';
    }
    function includeFooter(){
        include __DIR__.'/../layouts/footer.php';
    }