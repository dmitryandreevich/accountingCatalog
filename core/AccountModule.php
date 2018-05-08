<?php

namespace core;


use function Sodium\compare;

class AccountModule
{

    protected $dbConn; // поле для хранения дескриптора соединения с бд
    protected $connectInfo = [
        'host' => 'localhost',
        'dbname' => 'accounting',
        'username' => 'root',
        'password' => ''
    ]; // информация для соединения с базой данных
    protected $tableName = 'admins'; // имя таблицы
    public function __construct() // здесь происходит соединение с базой данных и создание таблицы если её нет
    {
        $this->dbConn = new \mysqli($this->connectInfo['host'],$this->connectInfo['username'],$this->connectInfo['password'], $this->connectInfo['dbname']);
        if($this->dbConn->connect_error)
            die('Connect error '.$this->dbConn->connect_error);
        $this->createTableAdmins();
    }
    public function __destruct() // закрытие соединения
    {
        $this->dbConn->close();
    }
    public function postListener(){ // данный метод "прослушивает" post запросы
        if(isset($_POST['sendLogin'])){ // если в post запросе пришёл логин
            $login = $_POST['login'];
            $password = $_POST['password'];

            $this->login($login, $password); // логинимся
        }
    }
    public static function isLogined(){ // проверка если пользователь залогинен
        return isset($_SESSION['login']);
    }
    public function login($login, $password){ // логин в аккаунт
        if(empty($login) || empty($password)) // проверка на ввод
            die('Логин или пароль не был ввёден!');
        $shaPass = hash('sha256', $password);// шифрование пароля
        // проверка есть ли такой пользователь
        $result = $this->dbConn->query("SELECT * FROM {$this->tableName} WHERE login='{$login}' and password='{$shaPass}'");
        if(empty($result->num_rows)) { // если нету

            die('Пользователя с данным именем и паролем не существует!');
        }
        $adminData = $result->fetch_assoc(); // получаем ассоциативный массив с результата запроса

        //session_start(); // старт сессии

        $_SESSION['login'] = $adminData['login']; // записываем в сессию на сервере логин

        header('Location: http://'. $_SERVER['HTTP_HOST'].'/');// смена локации (редирект)
        exit;
    }
    public static function logout(){

        // выход с аккаунта
        header('Location: http://'. $_SERVER['HTTP_HOST'].'/');
        session_destroy(); // удаление сессии

        exit;

    }
    public function addNewAdmin($login, $password){ // добавление нового администратора
        if(empty($login) || empty($password))
            die('Логин или пароль не был ввёден!');
        $result = $this->dbConn->query("SELECT login FROM {$this->tableName} WHERE login='{$login}'");
        if(empty($result->num_rows)) { // если нет такого администратора
            $shaPass = hash('sha256', $password);
            $this->dbConn->query("INSERT INTO {$this->tableName} (login,password) VALUES ('{$login}','{$shaPass}')");
        }
        else// если есть такой администратор
            die('Администратор с таким именем уже существует!');
    }

    private function createTableAdmins(){ // создание таблицы администраторов, если нет её
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