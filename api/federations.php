<?php
include("../db.php");

// query
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //set up optional sort clause
    $sortclause = '';
    if ($_GET['sortdirection'] == 'ASC') {
        $direction = 'ASC';
    } else {
        $direction = 'DESC';
    }
    $sortclause = "ORDER BY country_name $direction";
    
    //query
    $sql = "SELECT * 
            FROM twcp_federations
            $sortclause";
    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    } else {
        //encode data to json
        header('Content-Type: application/json');
        $federations = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($federations);
    }
} else {
    http_response_code(405);
    header("Allow: GET");
    echo "405 Method Not Allowed";
}
?>