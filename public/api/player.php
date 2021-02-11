<?php
$method = $_SERVER['REQUEST_METHOD'];

include("../../db.php");

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
        break;
    case 'DELETE':
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
