<?php
$method = $_SERVER['REQUEST_METHOD'];

include("../db.php");
include("../utils/functions.php");

if(!isset($_GET["id"])) {
    http_response_code(400);
    echo "No ID supplied";
    die();
}

$playerid = $conn->real_escape_string($_GET["id"]);

switch ($method) {

    case 'GET':
        $sql = "SELECT fide_id, name, country_name, birth_year, full_title, rating_standard, rating_rapid, rating_blitz, inactive, img_url
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title) 
            WHERE fide_id=$playerid";

        $result = $conn->query($sql);

        //set up response
        if (!$result) {
            echo $conn->error;
        } else {
            header('Content-Type: application/json');
            if ($player = $result->fetch_assoc()) {
                echo json_encode($player);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Player not found']);
            }
        }
        break;

    case 'POST':
        http_response_code(405);
        header("Allow: GET, PUT, DELETE");
        echo "405 Method Not Allowed";
        break;

    case 'PUT':
        //authentication
        $keycheck = authorized($conn, $_SERVER['HTTP_API_KEY'] ?? NULL);

        if (!$keycheck) {
            http_response_code(401);
            echo "401 Unauthorized";
            die();
         } else {
            // From https://lornajane.net/posts/2008/accessing-incoming-put-data-from-php
            parse_str(file_get_contents("php://input"), $_PUT);

            //create local variables
            $fideid = $playerid;
            $playername = $_PUT['inputPlayerName'];
            $federation = $_PUT['inputFederation'];
            $birthyear = $_PUT['inputBirthYear'] ?? NULL;
            $title = $_PUT['inputPlayerTitle'] ?? NULL;
            $ratingstd = $_PUT['ratingstandard'] ?? NULL;  
            $ratingrap = $_PUT['ratingrapid'] ?? NULL;
            $ratingblitz = $_PUT['ratingblitz'] ?? NULL;
            //if anything is in the status field, inactive = true, otherwise it's false
            $inactive = (int)($_PUT['status'] ?? false);
            $imgurl = $_PUT['inputImage'] ?? NULL;

            //prepared statement
            $stmt = $conn->prepare("
                UPDATE top_women_chess_players SET name = ?, federation = ?, birth_year = ?, title = ?, rating_standard = ?, rating_rapid = ?, rating_blitz = ?, inactive = ?, img_url = ? WHERE fide_id = ? 
                ");  
                    
            $stmt->bind_param("ssisiiiisi", $playername, $federation, $birthyear, $title, $ratingstd, $ratingrap, $ratingblitz, $inactive, $imgurl, $fideid);

            $stmt->execute();

            if ($stmt->error){
                echo $stmt->error;
                die();
            } else if ($stmt->affected_rows == 0) {
                // either player not found, or submitted values matched the status quo in db.
                echo "No updates made";
            } else {
                echo "Player {$fideid} Updated";
            }
        }
        break;

    case 'DELETE':
        //authentication
        $keycheck = authorized($conn, $_SERVER['HTTP_API_KEY'] ?? NULL);

        if (!$keycheck) {
            http_response_code(401);
            echo "401 Unauthorized";
            break;
         } else {
            $sql = "DELETE FROM top_women_chess_players WHERE fide_id=$playerid";

            $result = $conn->query($sql);
    
            if (!$result) {
                echo $conn->error;
            } 
            
            if ($conn->affected_rows > 0) {
                echo "Player {$playerid} Deleted";
            } else {
                echo "No player found";
            }
            break;
        }

    default:
        http_response_code(400);
        echo "400 Unknown Method";
        break;
}
