<?php
class Itens{
 
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

    // used by select drop-down list
    public function readOne($idOfClient){
        //select all data of client
        $query = "SELECT *
                FROM
                    ".$this->table_name.
                    " WHERE id_demand = " .$idOfClient."";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }

    
}
?>