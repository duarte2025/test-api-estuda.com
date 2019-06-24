<?php
class Demand{
 
    // database connection and table name
    private $conn;
    private $table_name = "demand";
 
    // object properties
    public $id;
    public $client_id;
    public $status;
    public $created;
    public $total_item;
    public $total_price;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readOne($idOfClient){
        //select all data of client
        $query = "SELECT *
                FROM
                    ".$this->table_name.
                    " WHERE client_id=" .$idOfClient."";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }
    // read demand
    function read(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
        
}
?>