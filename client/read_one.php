<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare client object
$client = new Client($db);
 
// set ID property of record to read
$idOfClient= isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of client to be edited
$stmt = $client->readOne($idOfClient);

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
        $client_item = array(
            "id" => $id,
            "nome" => $nome,
            "email" => $email
        );
 
    }
     // set response code - 200 OK
     http_response_code(200);
 
     // show products data in json format
     echo json_encode($client_item);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user client does not exist
    echo json_encode(array("message" => "client does not exist."));
}
?>