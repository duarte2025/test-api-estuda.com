<?php
class Demand{
 
    // database connection and table name
    private $conn;
    private $table_name = "itens";
 
    // object properties
    public $id_demand;
    public $id_product;
    public $quant;
    public $total_price;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
}
?>