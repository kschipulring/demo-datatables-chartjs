<?php
require_once 'main_include.php';

$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASS"];

$db = $_ENV["DB_NAME"];

//by default, the start is '0' or zero.  which record to start at.
$start = (isset($_GET["start"]) && is_numeric($_GET["start"])) ? $_GET["start"] : "0";

//number of records to return.
$length = (isset($_GET["length"]) && is_numeric($_GET["length"])) ? $_GET["length"] : "10";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //main query
    $query = 'SELECT * FROM ' . $_ENV["DB_TABLE"] . " LIMIT {$start}, {$length}";

    $sth = $conn->prepare( $query );
    $sth->execute();
    
    // Fetch all of the remaining rows in the result set
    $result = $sth->fetchAll(PDO::FETCH_OBJ);

    $result_obj = new stdClass();

    //the most important key
    $result_obj->data = $result;


    //now we need the complete number of ALL the records present
    $query_c = 'SELECT COUNT(*) AS recordsTotal FROM ' . $_ENV["DB_TABLE"];

    $sth_c = $conn->prepare( $query_c );
    $sth_c->execute();

    $result_c = $sth_c->fetchAll(PDO::FETCH_ASSOC);

    //now assign it to the main object
    $result_obj->recordsTotal = $result_c[0]["recordsTotal"];
    
    //output
    echo json_encode($result_obj);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
