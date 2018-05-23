<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,
        Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/transaction.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare transaction object
$transaction = new Transaction($db);

// get ID of transaction to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of transaction to be edited
$transaction->id = $data->id;

// set transaction property values
$transaction->name = $data->name;
$transaction->date = $data->date;
$transaction->value = $data->value;
$transaction->allocation_id = $data->allocation_id;
$transaction->recon_id = $data->recon_id;
$transaction->modified = date('Y-m-d H:i:s');

// update the product
if($transaction->update()){
  echo '{';
    echo '"message": "Transaction was updated."';
  echo '}';
}

// if unable to update the product, tell the user
else{
  echo '{';
    echo '"message":"Unable to update Transaction"';
  echo '}';
}
?>
