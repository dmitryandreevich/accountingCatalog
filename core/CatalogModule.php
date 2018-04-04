<?php

namespace core;


class CatalogModule
{
    protected $dbConn;
    protected $connectInfo = [
        'host' => 'localhost',
        'dbname' => 'accounting',
        'username' => 'root',
        'password' => ''
    ];
    protected $productQuality = 'all';
    protected $tableName = 'products';
    public function __construct()
    {
        $this->dbConn = new \mysqli($this->connectInfo['host'],$this->connectInfo['username'],$this->connectInfo['password'], $this->connectInfo['dbname']);
        if($this->dbConn->connect_error)
            die('Connect error '.$this->dbConn->connect_error);
        $this->createTableProducts();
    }
    public function __destruct()
    {
        $this->dbConn->close();
    }
    public function postListener(){
        if(isset($_POST['new'])) // если была нажата кнопка только для всех товаров
            $this->setProductsQuality('new'); // устанавливаем тип продукта для выборки из базы
        elseif(isset($_POST['old']))
            $this->setProductsQuality('old');

        if(isset($_POST['addProduct'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $quality = $_POST['productType'];
            $this->addNewProduct($name, $price, $count, $quality);
        }
        if(isset($_POST['delete']))
            $this->deleteProduct($_POST['delete']);
        if(isset($_POST['update'])){
            header('Location: http://'. $_SERVER['HTTP_HOST'].'/admin/update.php?id='.$_POST['update']);
            exit;
        }
        if(isset($_POST['updateProduct'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $quality = $_POST['productType'];

            $this->updateProduct($id, $name, $price, $count,$quality);
        }

    }
    public function getProducts(){
        $query = sprintf("SELECT id,name,count FROM products %s",  $this->productQuality == 'all' ? '' : 'WHERE quality="' . $this->productQuality. '"');
        $qResult = $this->dbConn->query($query);
        $products = array();
        for($i = 0; $i < $qResult->num_rows; $i++)
            array_push($products,$qResult->fetch_assoc());
        return $products;
    }
    public function setProductsQuality($quality){
        $this->productQuality = $quality;
    }
    private function createTableProducts(){
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
    public function addNewProduct($name,$price, $count, $quality){
        if(empty($name) || empty($price) || empty($count) || empty($quality)){
            die('Одно из полей пусто!');
        }
        $this->dbConn->query("INSERT INTO products (name, price, count, quality) VALUES ('{$name}',{$price},{$count}, '{$quality}')");
    }
    public function deleteProduct($id){
        if(empty($id))
            exit;
        $this->dbConn->query('DELETE FROM products WHERE id='.$id);
    }
    public function updateProduct($id, $name, $price, $count, $quality){
        if(empty($name) || empty($price) || empty($count) || empty($quality) || empty($id)){
            die('Одно из полей пусто!');
        }
        $this->dbConn->query("UPDATE products SET name='{$name}' , price={$price} , count={$count} , quality='{$quality}' WHERE id=". $id);

    }
    public function getProductById($id){
        if(empty($id))
            exit;
        $result = $this->dbConn->query('SELECT * FROM products WHERE id='. $id);
        if($result->num_rows == 0)
            die('Нет таких записей');
        $product = $result->fetch_assoc();
        return $product;
    }
}