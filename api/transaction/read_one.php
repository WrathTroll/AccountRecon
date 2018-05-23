<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// include database and object files
include_once '../config/database.php';
include_once '../objects/transaction.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare transaction object
$transaction = new Transaction($db);

// set ID property of transaction to be edited
$transaction->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$transaction->readOne();

// create array
$transaction_arr = array(
  "id" => $transaction->id,
  "name" => $transaction->name,
  "date" => $transaction->date,
  "value" => $transaction->value,
  "allocation_id" => $transaction->allocation_id,
  "allocation_name" => $transaction->allocation_name,
  "recon_id" => $transaction->recon_id,
  "recon_type_name" => $transaction->recon_type_name,
  "month" => $transaction->month,
  "year" => $transaction->year
);

// make it json format
print_r(json_encode($transaction_arr));
 ?>
