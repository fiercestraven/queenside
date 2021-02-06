<?php
    header('Content-Type: application/json');

    include("../../db.php");

    $playerid = $_GET["id"];

    $query = "SELECT * FROM top_women_chess_players WHERE fide_id=$playerid";

    $result = $conn->query($query);

    if(!$result) {
        echo $conn->error;
    } else {
        if ($row = $result->fetch_assoc()){
            print_r(json_encode($row));
        } else {
            http_response_code(404);
            echo "Player not found!";
        }
    }
?>