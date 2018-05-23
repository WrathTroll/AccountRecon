<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/transaction.php';

// instantiate database and transaction object
$database = new Database();
$db = $database->getConnection();

// initialize object
$transaction = new Transaction($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query products
$stmt = $transaction->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  // transaction array
  $transaction_arr = array();
  $transaction_arr["records"] = array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $transaction_item = array(
      "id" => $id,
      "name" => $name,
      "date" => $date,
      "value" => $value,
      "allocation_id" => $allocation_id,
      "allocation_name" => $allocation_name,
      "recon_id" => $recon_id,
      "recon_type_name" => $recon_type_name,
      "month" => $month,
      "year" => $year
    );

    array_push($transaction_arr["records"], $transaction_item);

  }

  echo json_encode($transaction_arr);
}else{
  echo json_encode(
      array("message"=>"No transactions found.")
    );
}
?>
