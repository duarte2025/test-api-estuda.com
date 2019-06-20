<?php
class Client{
 
    // database connection and table name
    private $conn;
    private $table_name = "cliente";
 
    // object properties
    public $id;
    public $nome;
    public $email;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
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
// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nome=:nome, email=:email";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->nome=htmlspecialchars(strip_tags($this->nome));
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind values
    $stmt->bindParam(":nome", $this->nome);
    $stmt->bindParam(":email", $this->email);

 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

}
?>