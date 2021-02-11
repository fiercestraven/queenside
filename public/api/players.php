<?php
$method = $_SERVER['REQUEST_METHOD'];

include("../../db.php");

switch ($method) {
    //read player
    case 'GET':
        $sql = "SELECT * FROM top_women_chess_players";

        $result = $conn->query($sql);
        
        if (!$result) {
            echo $conn->error;
        } else {
            $playerarr = array();
            while ($row = $result->fetch_assoc()) { 
                $playerarr[] = $row;
            }
            header('Content-Type: application/json');
            json_encode($playerarr);
        }
        break;
    case 'POST':
        $fideid = $conn->real_escape_string($_POST['inputFIDE']);
        $playername = $conn->real_escape_string($_POST['inputPlayerName']);
        $federation = $conn->real_escape_string($_POST['inputFederation']);
        $birthyear = $_POST['inputBirthYear'] ? "'" . $conn->real_escape_string($_POST['inputBirthYear']) . "'" : "NULL";
        $title = $_POST['inputPlayerTitle'] ? "'" . $conn->real_escape_string($_POST['inputPlayerTitle']) . "'" : "NULL";
        $ratingstd = $_POST['ratingstandard'] ? "'" . $conn->real_escape_string($_POST['ratingstandard']) . "'" : "NULL";
        $ratingrap = $_POST['ratingrapid'] ? "'" . $conn->real_escape_string($_POST['ratingrapid']) . "'" : "NULL";
        $ratingblitz = $_POST['ratingblitz'] ? "'" . $conn->real_escape_string($_POST['ratingblitz']) . "'" : "NULL";
        $inactive = (int)($_POST['status']);

        $sql = "INSERT INTO top_women_chess_players (fide_id,name,federation,birth_year,title,rating_standard,rating_rapid,rating_blitz,inactive) VALUES ('$fideid','$playername','$federation',$birthyear,$title,$ratingstd,$ratingrap,$ratingblitz,'$inactive')";

        $result = $conn->query($sql);
        if(!$result) {
            echo $conn->error;
            die();
        } else {
            echo "Data submitted";
        }
        break;
    case 'PUT':
        break;
    case 'DELETE':
        $sql = "DELETE FROM top_women_chess_players";
        //authentication here!
        $result = $conn->query($sql);

        if (!$result) {
            echo $conn->error;
        } else {
            if ($rows = $result->affected_rows) {
                echo "{$rows} player(s) deleted";
            } else {
                http_response_code(404);
                echo "no players deleted";
            }
        }
        break;
    default: 
        http_response_code(400);
        echo "unknown method";
        break;
}







