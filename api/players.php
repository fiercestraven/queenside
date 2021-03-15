<?php

$method = $_SERVER['REQUEST_METHOD'];

include("../db.php");
include("../utils/functions.php");

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
 
       //basic authentication
        if(!(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))) {
            http_response_code(401);
            echo "401 Unauthorized";
            break;
        }
        
        if (!checkauth($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $conn)) {
            http_response_code(401);
            echo "401 Unauthorized";
            break;
        }

        //create local variables
        $fideid = $_POST['inputFIDE'];
        $playername = $_POST['inputPlayerName'];
        $federation = $_POST['inputFederation'];
        $birthyear = $_POST['inputBirthYear'] ?? NULL;
        $title = $_POST['inputPlayerTitle'] ?? NULL;
        $ratingstd = $_POST['ratingstandard'] ?? NULL;  
        $ratingrap = $_POST['ratingrapid'] ?? NULL;
        $ratingblitz = $_POST['ratingblitz'] ?? NULL;
        //if anything is in the status field, inactive = true
        $inactive = isset($_POST['status']);

        //prepared statement
        $stmt = $conn->prepare("
            INSERT INTO top_women_chess_players (
                fide_id, name, federation, birth_year, title, rating_standard, rating_rapid, rating_blitz, inactive
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?
            )");       
        $stmt->bind_param("issisiiii", $fideid, $playername, $federation, $birthyear, $title, $ratingstd, $ratingrap, $ratingblitz, $inactive);
       
        $stmt->execute();

        if ($stmt->error){
            echo $stmt->error;
            die();
        } else {
            echo "Data submitted";
        }
        break;

    case 'PUT':
        http_response_code(405); 
        header("Allow: GET, POST");
        echo "405 Method Not Allowed";
        break;

    case 'DELETE':
        http_response_code(405); 
        header("Allow: GET, POST");
        echo "405 Method Not Allowed";
        break;

        //if I want to allow for deleting all players, un-comment the following
        // if(!(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))) {
        //     http_response_code(401);
        //     echo "401 Unauthorized";
        //     break;
        // }
        
        // if (!checkauth($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $conn)) {
        //     http_response_code(401);
        //     echo "401 Unauthorized";
        //     break;
        // }  

        // $sql = "DELETE FROM top_women_chess_players";

        // $result = $conn->query($sql);

        // if (!$result) {
        //     echo $conn->error;
        // } else {
        //     if ($rows = $result->affected_rows) {
        //         echo "{$rows} player(s) deleted";
        //     } else {
        //         http_response_code(404);
        //         echo "no players deleted";
        //     }
        // }
        // break;

    default: 
        http_response_code(400);
        echo "unknown method";
        break;
}






