<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,
        Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate transaction object
include_once '../objects/transaction.php';

$database = new Database();
$db = $database->getConnection();

$transaction = new Transaction($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set transaction property values
transaction->$name = $data->$name;
transaction->$date = $data->$date;
transaction->$value = $data->$value;
transaction->$allocation_id = $data->$allocation_id;
transaction->$recon_id = $data->$recon_id;
transaction->$created = date('Y-m-d H:i:s');

// create the transaction
if($transaction->create()){
  echo '{';
      echo '"message": "transaction was created."';
  echo '}';
}

// if unable to create the product, tell the user
else{
  echo '{';
    echo '"message": "Unable to create transaction"';
  echo '}';
}
?>
