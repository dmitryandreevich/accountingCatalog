<?php

namespace core;

class CatalogModule
{
    protected $dbConn;// поле для хранения дескриптора соединения с бд
    protected $connectInfo = [
        'host' => 'localhost',
        'dbname' => 'accounting',
        'username' => 'root',
        'password' => ''
    ];// информация для соединения с базой данных
    protected $productQuality = 'all';
    protected $tableName = 'products'; // имя таблицы
    public function __construct()// здесь происходит соединение с базой данных и создание таблицы если её нет
    {
        $this->dbConn = new \mysqli($this->connectInfo['host'],$this->connectInfo['username'],$this->connectInfo['password'], $this->connectInfo['dbname']);
        if($this->dbConn->connect_error)
            die('Connect error '.$this->dbConn->connect_error);
        $this->createTableProducts();
    }
    public function __destruct()// закрытие соединения
    {
        $this->dbConn->close();
    }
    public function postListener(){// данный метод "прослушивает" post запросы

        if(isset($_POST['new'])) // если была нажата кнопка только для всех товаров
            $this->setProductsQuality('new'); // устанавливаем тип продукта для выборки из базы
        elseif(isset($_POST['old']))
            $this->setProductsQuality('old');

        if(isset($_POST['addProduct'])){ // если пришёл запрос на добавление нового продукта
            $name = $_POST['name'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $quality = $_POST['productType'];
            $this->addNewProduct($name, $price, $count, $quality);// забираем с пост запроса все данные и добавляем его
        }
        if(isset($_POST['delete']))// если пришёл запрос на удаление продукта
            $this->deleteProduct($_POST['delete']);
        if(isset($_POST['update'])){ // если пришёл запрос на нажатие кнопки изменение продукта
            header('Location: http://'. $_SERVER['HTTP_HOST'].'/admin/update.php?id='.$_POST['update']);
            exit;
        }
        if(isset($_POST['updateProduct'])){ // если пришёл запрос на подтверждение изменения продукта
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $quality = $_POST['productType'];

            $this->updateProduct($id, $name, $price, $count,$quality);
        }

    }
    public function getProducts(){ // получение всех продуктов
        $query = sprintf("SELECT id,name,count FROM products %s",  $this->productQuality == 'all' ? '' : 'WHERE quality="' . $this->productQuality. '"');
        $qResult = $this->dbConn->query($query);
        $products = array();
        for($i = 0; $i < $qResult->num_rows; $i++)
            array_push($products,$qResult->fetch_assoc());
        return $products;
    }
    public function setProductsQuality($quality){ // установить отображаемый тип продукта
        $this->productQuality = $quality;
    }
    private function createTableProducts(){ // создание таблицы продуктов, если нет её
        $qResult = $this->dbConn->query('SELECT id FROM products');
        if(empty($qResult)){
            $query = "CREATE TABLE products (
                          id int(11) AUTO_INCREMENT,
                          name varchar(255) NOT NULL,
                          count int NOT NULL,
                          quality varchar(15) NOT NULL,
                          price int NOT NULL,
                          PRIMARY KEY  (id)
                          )";
            $this->dbConn->query($query);
        }
    }
    public function addNewProduct($name,$price, $count, $quality){ // метод для добавления продукта
        if(empty($name) || empty($price) || empty($count) || empty($quality)){
            die('Одно из полей пусто!');
        }
        $this->dbConn->query("INSERT INTO products (name, price, count, quality) VALUES ('{$name}',{$price},{$count}, '{$quality}')");
    }
    public function deleteProduct($id){// метод для удаление продукта
        if(empty($id))
            exit;
        $this->dbConn->query('DELETE FROM products WHERE id='.$id);
    }
    public function updateProduct($id, $name, $price, $count, $quality){// метод по обновлению продукта
        if(empty($name) || empty($price) || empty($count) || empty($quality) || empty($id)){
            die('Одно из полей пусто!');
        }
        $this->dbConn->query("UPDATE products SET name='{$name}' , price={$price} , count={$count} , quality='{$quality}' WHERE id=". $id);

    }
    public function getProductById($id){ // метод для получения продукта по его идентификатору
        if(empty($id))
            exit;
        $result = $this->dbConn->query('SELECT * FROM products WHERE id='. $id);
        if($result->num_rows == 0)
            die('Нет таких записей');
        $product = $result->fetch_assoc();
        return $product;
    }
}