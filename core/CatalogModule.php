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
                          PRIMARY KEY  (id)
                          )";
            $this->dbConn->query($query);
        }
    }
}