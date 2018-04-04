<?php

namespace core;


class AdminModule
{
    public static function redirectToDashboard(){
        header('Location: http://'. $_SERVER['HTTP_HOST'].'/admin/dashboard.php');
        exit;
    }

}