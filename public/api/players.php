<?php
    header('Content-Type: application/json');

    include("../../db.php");

    $query = "SELECT * FROM top_women_chess_players";

    $result = $conn->query($query);

    if(!$result) {
        echo $conn->error;
    } else {
        $playerarr = array();
        while($row = $result->fetch_assoc()) {
            $playerarr[] = $row;
        }
        print_r(json_encode($playerarr));
    }
 
?>