<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readAll(){
        //select all data
        $query = "SELECT
                    id, name, description
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }
    
    // used by select drop-down list
    public function read(){
    
        //select all data
        $query = "SELECT
                    id, name, price, description
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
    
        return $stmt;
    }
    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    name=:name, description=:description, price=:price";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

}
?>