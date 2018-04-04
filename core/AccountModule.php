<?php

namespace core;


use function Sodium\compare;

class AccountModule
{
    protected $dbConn;
    protected $connectInfo = [
        'host' => 'localhost',
        'dbname' => 'accounting',
        'username' => 'root',
        'password' => ''
    ];
    protected $tableName = 'admins';
    public function __construct()
    {
        $this->dbConn = new \mysqli($this->connectInfo['host'],$this->connectInfo['username'],$this->connectInfo['password'], $this->connectInfo['dbname']);
        if($this->dbConn->connect_error)
            die('Connect error '.$this->dbConn->connect_error);
        $this->createTableAdmins();
    }
    public function __destruct()
    {
        $this->dbConn->close();
    }
    public function postListener(){
        if(isset($_POST['sendLogin'])){
            $login = $_POST['login'];
            $password = $_POST['password'];

            $this->login($login, $password);
        }
    }
    public static function isLogined(){
        return isset($_SESSION['login']);
    }
    public function login($login, $password){
        if(empty($login) || empty($password))
            die('Логин или пароль не был ввёден!');
        $shaPass = hash('sha256', $password);

        $result = $this->dbConn->query("SELECT * FROM {$this->tableName} WHERE login='{$login}' and password='{$shaPass}'");
        if(empty($result->num_rows)) {

            die('Пользователя с данным именем и паролем не существует!');
        }
        $adminData = $result->fetch_assoc();

        session_start();

        $_SESSION['login'] = $adminData['login'];

        return true;
    }
    public static function logout(){

        //header('Location: http://'. $_SERVER['HTTP_HOST'].'/');
        session_destroy();
        //die();
    }
    public function addNewAdmin($login, $password){
        if(empty($login) || empty($password))
            die('Логин или пароль не был ввёден!');
        $result = $this->dbConn->query("SELECT login FROM {$this->tableName} WHERE login='{$login}'");
        if(empty($result->num_rows)) {
            $shaPass = hash('sha256', $password);
            $this->dbConn->query("INSERT INTO {$this->tableName} (login,password) VALUES ('{$login}','{$shaPass}')");
        }
        else
            die('Администратор с таким именем уже существует!');
    }

    private function createTableAdmins(){
        $qResult = $this->dbConn->query('SELECT id FROM '.$this->tableName);
        if(empty($qResult)){
            $query = "CREATE TABLE admins (
                          id int(11) AUTO_INCREMENT,
                          login varchar(255) NOT NULL,
                          password varchar(255) NOT NULL,
                          PRIMARY KEY  (id)
                          )";
            $this->dbConn->query($query);
        }
    }
}