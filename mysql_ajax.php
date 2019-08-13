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

//yes, we need this
$draw = (isset($_GET["draw"]) && is_numeric($_GET["draw"])) ? $_GET["draw"] : "1";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //main query
    $query = 'SELECT * FROM ' . $_ENV["DB_TABLE"];

    $q_where = "";

    if( isset($_GET["search"]) && isset( $_GET["search"]["value"] ) && strlen($_GET["search"]["value"]) > 0 ){
        $search = $_GET["search"]["value"];

        $sql_str_arr = [];

        for( $i=0; $i<count($cols); $i++ ){
            $sql_str_arr []= "{$cols[$i]} LIKE '%{$search}%' \n\t<br/>";
        }

        $sql_str = implode( "OR ", $sql_str_arr );

        $q_where .= " WHERE ({$sql_str}})";
    }

    $q_orderby = "";

    //yes, I do heavy defensive programming
    if( isset($_GET["order"]) && isset($_GET["order"][0]) && isset($_GET["order"][0]["column"]) && $_GET["order"][0]["column"] > 0 ){
        $order_arr = $cols;

        $o_index = $_GET["order"][0]["column"];

        $q_orderby = " ORDER BY " . $order_arr[ $o_index ] . " ";

        if( isset($_GET["order"][0]["dir"]) ){
            $q_orderby .= $_GET["order"][0]["dir"];
        }

    }

    $final_main_query = $query . $q_where . $q_orderby . " LIMIT {$start}, {$length}";

    $sth = $conn->prepare( $final_main_query );
    $sth->execute();
    
    // Fetch all of the remaining rows in the result set
    $result = $sth->fetchAll(PDO::FETCH_OBJ);

    $result_obj = new stdClass();

    //the most important key
    $result_obj->data = $result;


    //now we need the complete number of ALL the records present
    $query_c = 'SELECT COUNT(*) AS recordsTotal FROM ' . $_ENV["DB_TABLE"];


    $sth_c = $conn->prepare( $query_c . $q_where );
    $sth_c->execute();

    $result_c = $sth_c->fetchAll(PDO::FETCH_ASSOC);

    //now assign it to the main object
    $result_obj->recordsTotal = $result_c[0]["recordsTotal"];

    $result_obj->recordsFiltered = $result_c[0]["recordsTotal"];

    //work with the draw value
    $result_obj->draw = $draw;
    
    //output
    echo json_encode($result_obj);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
