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
        $query = "SELECT c.name as product_name, p.id_demand, p.quant, p.total_price
                FROM
                    ".$this->table_name.
                    " p LEFT JOIN
                    products c
                        ON p.id_product = c.id WHERE p.id_demand = " .$idOfClient."";
                        
        
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }



    
}
?>