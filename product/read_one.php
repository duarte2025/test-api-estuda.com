<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$product = new Product($db);
 
// set ID property of record to read
$idOfProduct= isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$stmt = $product->readOne($idOfProduct);

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
    
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        // create array
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "price" => $price,
            "description" => html_entity_decode($description)
        );
    }
     // set response code - 200 OK
     http_response_code(200);
 
     // show products data in json format
     echo json_encode($product_item);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "product does not exist."));
}
?>