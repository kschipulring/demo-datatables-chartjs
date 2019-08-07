<?php
require_once 'main_include.php';

$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASS"];

$db = $_ENV["DB_NAME"];

//by default, the start is '0' or zero
$start = (isset($_GET["start"]) && is_numeric($_GET["start"])) ? $_GET["start"] : "0";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = [];

    $query = 'SELECT * FROM ' . $_ENV["DB_TABLE"] . " LIMIT {$start}, 4";

    $sth = $conn->prepare( $query );
    $sth->execute();
    
    // Fetch all of the remaining rows in the result set
    $result = $sth->fetchAll(PDO::FETCH_OBJ);

    $result_obj = new stdClass();

    $result_obj->data = $result;
    
    //output
    echo json_encode($result_obj);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
