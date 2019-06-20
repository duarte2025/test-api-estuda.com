<?php
class Demand{
 
    // database connection and table name
    private $conn;
    private $table_name = "demand";
 
    // object properties
    public $id;
    public $cliend_id;
    public $status;
    public $created;
    public $total_item;
    public $total_price;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
}
?>