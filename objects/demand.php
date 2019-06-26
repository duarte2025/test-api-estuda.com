<?php
class Demand{
 
    // database connection and table client_id
    private $conn;
    private $table_client_id = "demand";
 
    // object properties
    public $id;
    public $client_id;
    public $status;
    public $created;
    public $total_item;
    public $total_data;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    public function readOne($idOfClient){
        //select all data of client
        $query = "SELECT *
                FROM
                    ".$this->table_client_id.
                    " WHERE id=" .$idOfClient."";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }
    // used by select drop-down list
    public function readClient($idOfClient){
        //select all data of client
        $query = "SELECT *
                FROM
                    ".$this->table_client_id.
                    " WHERE client_id=" .$idOfClient."";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }
    // read demand
    function read(){

        // select all query
        $query = "SELECT
                    c.nome as client_nome, p.id, p.created, p.status, p.total_price, p.total_item
                FROM
                    " . $this->table_client_id . " p LEFT JOIN cliente c ON p.client_id = c.id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // delete the client
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_client_id . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }   
        // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_client_id . "
                SET
                    client_id=:client_id, status=:status, created=:created, total_item=0 total_price=0";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        echo($query);
        // sanitize
        $this->client_id=htmlspecialchars(strip_tags($this->client_id));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created", $this->created);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
        
}
?>