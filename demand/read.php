<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/demand.php';
 
// instantiate database and demand object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$demand = new Demand($db);
 
// read demand will be here

// query demand
$stmt = $demand->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // demand array
    $demand_arr=array();
    $demand_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $demand_item=array(
            "id" => $id,
            "created" => $created,
            "status" => $status,
            "total_item" => $total_item,
            "total_price" => $total_price,
            "client_nome" => $client_nome
        );
 
        array_push($demand_arr["records"], $demand_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show demand data in json format
    echo json_encode($demand_arr);
}
 
// no demand found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>