<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate demands object
include_once '../objects/itens.php';
 
$database = new Database();
$db = $database->getConnection();
 
$demands = new Itens($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    !empty($data->id_demand) &&
    !empty($data->id_product) &&
    !empty($data->quant) &&
    !empty($data->total_price)
){
 
    // set demands property values
    $demands->id_demand = $data->id_demand;
    $demands->id_product = $data->id_product;
    $demands->quant = $data->quant;
    $demands->total_price = $data->total_price;
 
    // create the demands
    if($demands->create()){
 
        // set response code - 201 id_demand
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "demands was id_demand."));
    }
 
    // if unable to create the demands, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
       // echo json_encode(array("message" => "Unable to create demands."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
  //  echo json_encode(array("message" => "Unable to create demands. Data is incomplete."));
}
?>