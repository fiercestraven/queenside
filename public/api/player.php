<?php
$method = $_SERVER['REQUEST_METHOD'];

include("../../db.php");
include("../../utils/functions.php");

$playerid = $_GET["id"];

switch ($method) {
    //read player
    case 'GET':
        $sql = "SELECT * FROM top_women_chess_players WHERE fide_id=$playerid";

        $result = $conn->query($sql);

        if (!$result) {
            echo $conn->error;
        } else {
            if ($row = $result->fetch_assoc()) {
                header('Content-Type: application/json');
                echo json_encode($row);
            } else {
                http_response_code(404);
                echo "404 Player Not Found";
            }
        }
        break;

    case 'POST':
        http_response_code(405);
        header("Allow: GET, PUT, DELETE");
        echo "405 Method Not Allowed";
        break;

    case 'PUT':
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

        // From https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php
        parse_str(file_get_contents("php://input"), $_PUT);

        //create local variables-- no real_escape_string needed due to prepare/bind steps below
        $fideid = $playerid;

        $playername = $_PUT['inputPlayerName'];
        $federation = $_PUT['inputFederation'];
        $birthyear = $_PUT['inputBirthYear'] ?? NULL;
        $title = $_PUT['inputPlayerTitle'] ?? NULL;
        $ratingstd = $_PUT['ratingstandard'] ?? NULL;  
        $ratingrap = $_PUT['ratingrapid'] ?? NULL;
        $ratingblitz = $_PUT['ratingblitz'] ?? NULL;
        //if anything is in the status field, inactive = true
        $inactive = isset($_PUT['status']);

        //to handle null data and escape the variables, per PHP docs
        $stmt = $conn->prepare("
            UPDATE top_women_chess_players SET name = ?, federation = ?, birth_year = ?, title = ?, rating_standard = ?, rating_rapid = ?, rating_blitz = ?, inactive = ? WHERE fide_id = ? 
            ");  
                 
        $stmt->bind_param("ssisiiiii", $playername, $federation, $birthyear, $title, $ratingstd, $ratingrap, $ratingblitz, $inactive, $fideid);

        $stmt->execute();

        if ($stmt->error){
            echo $stmt->error;
            die();
        } else if ($stmt->affected_rows == 0) {
            echo "No players found";
        } else {
            echo "Player {$fideid} Updated";
        }
        break;

    case 'DELETE':
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

        $sql = "DELETE FROM top_women_chess_players WHERE fide_id=$playerid";

        $result = $conn->query($sql);

        if (!$result) {
            echo $conn->error;
        } else {
            echo "Player {$playerid} Deleted";
        }
        break;

    default:
        http_response_code(400);
        echo "400 Unknown Method";
        break;
}
