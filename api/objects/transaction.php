<?php
class Transaction{

  // database connection and table name
  private $conn;
  private $table_name = "transaction";

  // object properties
  public $id;
  public $name;
  public $date;
  public $value;
  public $allocation_id;
  public $recon_id;
  public $allocation_name;
  public $month;
  public $year;
  public $recon_type_name;
  public $created;
  public $modified;

  // constructor with $db as database connection
  public function __construct($db){
    $this->conn = $db;
  }

  // read transactions
  function read(){
    // select all query
    $query = "SELECT
                a.name as allocation_name, r.month as month, r.year as year ,rt.name as recon_type_name,t.id,
                t.name, t.date, t.value, t.allocation_id, t.recon_id, t.created
              FROM
                ". $this->table_name . " t
                LEFT JOIN
                  allocation a
                    ON t.allocation_id = a.id
                LEFT JOIN
                  recon r
                    ON t.recon_id = r.id
                      LEFT JOIN
                        recon_type rt
                          ON r.recon_type_id = rt.id
              ORDER BY
                t.created DESC";
    // prepare the statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  // create product
  function create(){
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
              name=:name, date=:date, value=:value, allocation_id=:allocation_id,
              recon_id=:recon_id, created=:created";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->date=htmlspecialchars(strip_tags($this->date));
    $this->value=htmlspecialchars(strip_tags($this->value));
    $this->allocation_id=htmlspecialchars(strip_tags($this->allocation_id));
    $this->recon_id=htmlspecialchars(strip_tags($this->recon_id));
    $this->created=htmlspecialchars(strip_tags($this->created));

    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":value", $this->value);
    $stmt->bindParam(":allocation_id", $this->allocation_id);
    $stmt->bindParam(":recon_id", $this->recon_id);
    $stmt->bindParam(":created", $this->created);

    // execute query
    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function readOne(){

    // query to read single record
    $query = "SELECT
                a.name as allocation_name, r.month as month, r.year as year ,rt.name as recon_type_name,t.id,
                t.name, t.date, t.value, t.allocation_id, t.recon_id, t.created
              FROM
                ". $this->table_name . " t
                LEFT JOIN
                  allocation a
                    ON t.allocation_id = a.id
                LEFT JOIN
                  recon r
                    ON t.recon_id = r.id
                      LEFT JOIN
                        recon_type rt
                          ON r.recon_type_id = rt.id
              WHERE
                t.id = ?
              LIMIT
                0,1";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind id of transaction to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();

    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set values to object properties
    $this->name = $row['name'];
    $this->date = $row['date'];
    $this->value = $row['value'];
    $this->allocation_id = $row['allocation_id'];
    $this->recon_id = $row['recon_id'];
    $this->allocation_name = $row['allocation_name'];
    $this->month = $row['month'];
    $this->year = $row['year'];
    $this->recon_type_name = $row['recon_type_name'];
  }

  // update the transaction
  function update(){
    // update query
    $query = "UPDATE
              " . $this->table_name . "
            SET
              name = :name,
              date = :date,
              value = :value,
              allocation_id = :allocation_id,
              recon_id = :recon_id,
              modified =:modified
            WHERE
              id =:id";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->date=htmlspecialchars(strip_tags($this->date));
    $this->value=htmlspecialchars(strip_tags($this->value));
    $this->allocation_id=htmlspecialchars(strip_tags($this->allocation_id));
    $this->recon_id=htmlspecialchars(strip_tags($this->recon_id));
    $this->modified=htmlspecialchars(strip_tags($this->modified));

    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":value", $this->value);
    $stmt->bindParam(":allocation_id", $this->allocation_id);
    $stmt->bindParam(":recon_id", $this->recon_id);
    $stmt->bindParam(":modified", $this->modified);

    // execute query
    if($stmt->execute()){
      return true;
    }

    return false;

  }

  // delete the transaction
  function delete(){

    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    // prepare query
    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));

    // bind id of record to delete
    $stmt->bindParam(1, $this->id);

    // execute query
    if($stmt->execute()){
      return true;
    }

    return false;

  }

  function search($keywords){

    // select all query
    $query = "SELECT
                a.name as allocation_name, r.month as month, r.year as year ,rt.name as recon_type_name,t.id,
                t.name, t.date, t.value, t.allocation_id, t.recon_id, t.created
              FROM
                ". $this->table_name . " t
                LEFT JOIN
                  allocation a
                    ON t.allocation_id = a.id
                LEFT JOIN
                  recon r
                    ON t.recon_id = r.id
                      LEFT JOIN
                        recon_type rt
                          ON r.recon_type_id = rt.id
              WHERE
                t.name LIKE ? OR a.name LIKE ? OR rt.name LIKE ?
              ORDER BY
                t.created DESC";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // sanitize
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    // execute query
    $stmt->execute();

    return $stmt;
  }

  // read transactions with pagination
  public function readPaging($from_record_num, $records_per_page){
    // select query
    $query = "SELECT
                a.name as allocation_name, r.month as month, r.year as year ,rt.name as recon_type_name,t.id,
                t.name, t.date, t.value, t.allocation_id, t.recon_id, t.created
              FROM
                ". $this->table_name . " t
                LEFT JOIN
                  allocation a
                    ON t.allocation_id = a.id
                LEFT JOIN
                  recon r
                    ON t.recon_id = r.id
                      LEFT JOIN
                        recon_type rt
                          ON r.recon_type_id = rt.id
              ORDER BY t.created DESC
              LIMIT ?, ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );

    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // execute query
    $stmt->execute();

    // return values from database
    return $stmt;
  }

  public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
 ?>
