<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
 
// instantiate database and client object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$client = new Client($db);
 
// read client will be here

// query client
$stmt = $client->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // client array
    $client_arr=array();
    $client_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $client_item=array(
            "id" => $id,
            "nome" => $nome,
            "email" => $email
        );
 
        array_push($client_arr["records"], $client_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show client data in json format
    echo json_encode($client_arr);
}
 
// no client found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>