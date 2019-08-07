<?php
require_once 'main_include.php';

$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASS"];

$db = $_ENV["DB_NAME"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

