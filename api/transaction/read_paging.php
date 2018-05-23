<?php
// required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/transaction.php';

// utilities
$utilities = new Utilities();

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$transaction = new Transaction($db);

// query transactions
$stmt = $transaction->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// check if more than 0 records found
if($num>0){

  // transactions array
  $transaction_arr = array();
  $transaction_arr['records'] = array();
  $transaction_arr['paging'] = array();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    //extract row
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

  // include paging
  $total_rows = $transaction->count();
  $page_url = "{$home_url}transaction/read_paging.php?";
  $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
  $transaction_arr["paging"] = $paging;

  echo json_encode($transaction_arr);
} else {
    echo json_encode(
      array("message"=>"No products found.")
    );
}
?>
