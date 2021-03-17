<?php

$method = $_SERVER['REQUEST_METHOD'];

include("../db.php");
include("../utils/functions.php");

switch ($method) {
        //read players
    case 'GET':
        //set up filters to work
        $clauses = array();

        if (isset($_GET['playerid']) && $_GET['playerid']) {
            $playerid = (int)($_GET['playerid']);
            $clauses[] = "fide_id = $playerid";
        }

        if (isset($_GET['playername']) && $_GET['playername']) {
            $playername = $conn->real_escape_string($_GET['playername']);
            $playernamevalue = htmlspecialchars($_GET['playername']);
            $clauses[] = "name LIKE '%$playername%' ";
        }

        if (isset($_GET['statusswitch']) && $_GET['statusswitch']) {
            $inactive = (int)($_GET['statusswitch']);
            $clauses[] = "inactive = $inactive";
        }

        if (isset($_GET['playertitle']) && $_GET['playertitle']) {
            $playertitle = $conn->real_escape_string($_GET['playertitle']);
            $playertitlevalue = htmlspecialchars($_GET['playertitle']);
            $clauses[] = "title = '$playertitle'";
        }

        if (isset($_GET['playercountry']) && $_GET['playercountry']) {
            $playerfed = $conn->real_escape_string($_GET['playercountry']);
            $playerfedvalue = htmlspecialchars($_GET['playercountry']);
            $clauses[] = "federation = '$playerfed'";
        }

        $whereclause = '';

        //build up WHERE clauses for filtering
        if (count($clauses) > 0) {
            $whereclause = 'WHERE ' . join(' AND ', $clauses);
        }

        //set up sort clause for main query
        $sortclause = '';

        if (isset($_GET['sortfield'])) {
            switch ($_GET['sortfield']) {
                case 'fideid':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY fide_id $direction";
                    break;

                case 'name':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY name $direction";
                    break;

                case 'federation':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY country_name $direction";
                    break;

                case 'birthyear':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY birth_year $direction";
                    break;

                case 'title':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY title $direction";
                    break;

                case 'ratingstd':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY rating_standard $direction";
                    break;

                case 'ratingrap':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY rating_rapid $direction";
                    break;

                case 'ratingblitz':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY rating_blitz $direction";
                    break;

                case 'status':
                    if ($_GET['sortdirection'] == 'ASC') {
                        $direction = 'ASC';
                    } else {
                        $direction = 'DESC';
                    }
                    $sortclause = "ORDER BY inactive $direction";
                    break;

                default:
                    break;
            }
        }

        //get count of how many players for pagination purposes
        $sqlcount = "SELECT COUNT(*) 
            FROM top_women_chess_players
            $whereclause";
        $countresult = $conn->query($sqlcount);
        $count = $countresult->fetch_array()[0];

        //set up how many results per page
        $per_page = 30;
        $page = (int)($_GET['page'] ?? 1);

        //round up for final page
        $last_page = ceil($count / $per_page);

        //handle page count of 0 or below
        if ($page < 1) {
            $page = 1;
        }

        //calculate correct offset
        $offset = $per_page * ($page - 1);

        // sql main query including LIMIT and OFFSET for page population
        $sql = "SELECT fide_id, name, country_name, birth_year, full_title, rating_standard, rating_rapid, rating_blitz, inactive
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title) 
            $whereclause
            $sortclause
            LIMIT $per_page
            OFFSET $offset";
        $result = $conn->query($sql);

        if (!$result) {
            echo $conn->error;
        } else {
            header('Content-Type: application/json');
            $playerarr = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($playerarr);
        }
        break;

    case 'POST':
        //authentication
        $keycheck = authorized($conn, $_SERVER['HTTP_API_KEY'] ?? NULL);

        if (!$keycheck) {
            http_response_code(401);
            echo "401 Unauthorized";
            break;
        } else {
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

            if ($stmt->error) {
                echo $stmt->error;
                die();
            } else {
                echo "Data submitted";
            }
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
        // $keycheck = authorized($conn, $_SERVER['HTTP_API_KEY'] ?? NULL);

        // if (!$keycheck) {
        //     http_response_code(401);
        //     echo "401 Unauthorized";
        //     break;
        //  } else {
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
        //  }
        // break;

    default:
        http_response_code(400);
        echo "unknown method";
        break;
}
