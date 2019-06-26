<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/demand.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare demand object
$demand = new Demand($db);
 
// set ID property of record to read
$idOfDemand= isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of demand to be edited
$stmt = $demand->readOne($idOfDemand);

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['created'] to
        // just $created only
        extract($row);
        
        // create array
        $demand_item=array(
            "id" => $id,
            "created" => $created,
            "total_item" => $total_item,
            "client_id" => $client_id,
            "total_price" => $total_price
        );
    }
     // set response code - 200 OK
     http_response_code(200);
 
     // show demands data in json format
     echo json_encode($demand_item);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user demand does not exist
    echo json_encode(array("message" => "demand does not exist."));
}
?>