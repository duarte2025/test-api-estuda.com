<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/itens.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare itens object
$itens = new Itens($db);
 
// set ID property of record to read
$idOfClient= isset($_GET['id_demand']) ? $_GET['id_demand'] : die();
 
// read the details of itens to be edited
$stmt = $itens->readOne($idOfClient);

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $itens_arr=array();
    $itens_arr["records"]=array();
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        // create array
        $itens_item = array(
            "id_demand" => $id_demand,
            "id_product" => $id_product,
            "quant" => $quant,
            "total_price" => $total_price
        );
 
        array_push($itens_arr["records"], $itens_item);
    }
     // set response code - 200 OK
     http_response_code(200);
 
     // show products data in json format
     echo json_encode($itens_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user itens does not exist
    echo json_encode(array("message" => "itens does not exist."));
}
?>