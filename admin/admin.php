<?php
include('../utils/functions.php');
checksessionuser();

include('../db.php');

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
$sql = "SELECT * 
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title) 
            $whereclause
            $sortclause
            LIMIT $per_page
            OFFSET $offset";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../_partials/head.html");
    ?>
</head>

<body>
    <!-- logo and nav -->
    <?php
    include("../_partials/adminnav.html");
    ?>

    <!-- Filtering options for players -->
    <div class="container my-container">
        <div class="row">
            <div class="col-sm-7"></div>
            <div class="col-sm-3">
                <?php
                echo "<p id='my-login-confirmation'>Logged in as {$_SESSION['admin_40275431']}</p>";
                ?>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-secondary my-logout-button" role="button" href="../admin/logout.php">Log Out</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-sm-3">
                <form id="ajaxform" method="POST" action="createtoken.php">
                    <button type="submit" class="btn btn-info">Generate API Token</button>
                </form>
            </div>    
        </div>

        <!-- create place for ajax response -->
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <p id="response"></p>
            </div>
        

        <script>
            $("#ajaxform").submit(function(event) {
                event.preventDefault();

                $.ajax({
                type: "POST",
                url: 'createtoken.php',
                success: function(token) {
                    $("#response").html(token);
                }
                });
            })
        </script>

        <div class="row">
            <h1 class="player-intro">Admin Player Search</h1>
        </div>

        <!-- search filters -->
        <div class="row">
            <h4>Search Filters</h4>
            <form method="GET">
                <div class="row mb-3">
                    <!-- FIDE -->
                    <label for="FIDE" class="col-sm-1 col-form-label">FIDE ID</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="playerid" value="<?php echo $playerid ?? '' ?>" placeholder="e.g. 12345" id="FIDE">
                    </div>
                    <!-- name -->
                    <label for="name" class="col-sm-1 col-form-label me-2">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="playername" value="<?php echo $playernamevalue ?? '' ?>" placeholder="First and/or last name" id="name">
                    </div>
                    <!-- Status -->
                    <legend class="col-sm-2 col-form-label" id="statusswitch">Exclude inactive players?</legend>
                    <div class="col-sm-1" style="padding-top: 7px;">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="statusswitch" value="status" <?php if (isset($inactive)) {
                                                                                                                    echo 'checked';
                                                                                                                } ?> id="statusswitch">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Title -->
                    <label for="title" class="col-sm-1 col-form-label">Title</label>
                    <div class="col-sm-3">
                        <select class="form-select" aria-label="Dropdown selection for player title" name="playertitle" id="title">
                            <option value="">Select</option>
                            <?php
                            //not escaping as this table is not edited by other users
                            $sqltitle = "SELECT * FROM twcp_titles ORDER BY full_title ASC";
                            $resulttitle = $conn->query($sqltitle);

                            if ($resulttitle) {
                                while ($chesstitle = $resulttitle->fetch_assoc()) {
                                    echo "<option value='{$chesstitle['title']}'";
                                    if (isset($playertitlevalue) && ($chesstitle['title'] == $playertitlevalue)) {
                                        echo "selected";
                                    }
                                    echo ">{$chesstitle['full_title']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- federation -->
                    <label for="fed" class="col-sm-1 col-form-label me-2">Federation</label>
                    <div class="col-sm-4">
                        <select class="form-select" aria-label="Dropdown selection for player federation" name="playercountry" id="fed">
                            <option value="">Select</option>
                            <?php
                            //not escaping as this table is not edited by other users
                            $sqlfed = "SELECT * FROM twcp_federations ORDER BY country_name ASC";
                            $resultfed = $conn->query($sqlfed);

                            if ($resultfed) {
                                while ($fed = $resultfed->fetch_assoc()) {
                                    echo "<option value='{$fed['federation']}'";
                                    if (isset($playerfedvalue) && ($fed['federation'] == $playerfedvalue)) {
                                        echo "selected";
                                    }
                                    echo ">{$fed['country_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Submit -->
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-secondary">Apply</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
    </div>

    <!-- player table-->
    <div class="container my-container">
        <h4>Internationally Ranked Women Chess Players</h4>
        <?php
        if ($count > 0) {
            echo "<p>$count results found</p>";
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- set up sort & header for FIDE ID -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'fideid') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qsfide = http_build_query(array_merge($_GET, array("sortfield" => "fideid", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsfide ?>'>FIDE ID <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for player name -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'name') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qsname = http_build_query(array_merge($_GET, array("sortfield" => "name", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsname ?>'>Name <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for federation -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'federation') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qsfed = http_build_query(array_merge($_GET, array("sortfield" => "federation", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsfed ?>'>Federation <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for birth year -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'birthyear') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qsby = http_build_query(array_merge($_GET, array("sortfield" => "birthyear", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsby ?>'>Birth Year <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for title -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'title') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qstit = http_build_query(array_merge($_GET, array("sortfield" => "title", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qstit ?>'>Chess Title <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for standard rating -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'DESC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'ratingstd') {
                        $sortflip = 'ASC';
                    } else {
                        $sortflip = 'DESC';
                    }
                    $qssr = http_build_query(array_merge($_GET, array("sortfield" => "ratingstd", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qssr ?>'>Standard Rating <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for rapid rating -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'DESC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'ratingrap') {
                        $sortflip = 'ASC';
                    } else {
                        $sortflip = 'DESC';
                    }
                    $qsrap = http_build_query(array_merge($_GET, array("sortfield" => "ratingrap", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsrap ?>'>Rapid Rating <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for blitz rating -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'DESC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'ratingblitz') {
                        $sortflip = 'ASC';
                    } else {
                        $sortflip = 'DESC';
                    }
                    $qsbl = http_build_query(array_merge($_GET, array("sortfield" => "ratingblitz", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsbl ?>'>Blitz Rating <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>

                    <!-- set up sort & header for status -->
                    <?php
                    if (isset($_GET['sortdirection']) && $_GET['sortdirection'] == 'ASC' && isset($_GET['sortfield']) && $_GET['sortfield'] == 'status') {
                        $sortflip = 'DESC';
                    } else {
                        $sortflip = 'ASC';
                    }
                    $qsst = http_build_query(array_merge($_GET, array("sortfield" => "status", "sortdirection" => $sortflip, "page" => 1)));
                    ?>
                    <th scope="col"><a class='my-light-link' href='?<?= $qsst ?>'>Status <i class="fa fa-arrows-v" aria-hidden="true"></i></a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$result || $result->num_rows == 0) {
                    echo "<tr>
                        <td colspan=9>No results found</td>
                    </tr>";
                } else {
                    for ($i = 1; $i <= $per_page; $i++) {
                        $player = $result->fetch_assoc();
                        if (!$player) {
                            break;
                        }

                        $fide = $player['fide_id'];
                        $name = htmlspecialchars($player['name']);
                        $fed = htmlspecialchars($player['country_name']);
                        $birth = $player['birth_year'] ?? 'Unknown';
                        $title = htmlspecialchars($player['full_title'] ?? '--');
                        $ratingstd = $player['rating_standard'] ?? '--';
                        $ratingrap = $player['rating_rapid'] ?? '--';
                        $ratingblitz = $player['rating_blitz'] ?? '--';
                        $inactive = $player['inactive'];

                        echo "<tr>
                        <td>{$fide}</td>
                        <td><a class='my-light-link' href='playeredit.php?id={$fide}'>{$name}</a></td>
                        <td>{$fed}</td>
                        <td>{$birth}</td>
                        <td>{$title}</td>
                        <td>{$ratingstd}</td>
                        <td>{$ratingrap}</td>
                        <td>{$ratingblitz}</td>";
                        if ($inactive) {
                            echo "<td>Withdrawn</td>";
                        } else {
                            echo "<td>Active</td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <?php
                // https://stackoverflow.com/questions/8562613/how-to-add-url-parameter-to-the-current-url#answer-41703064
                $qs = http_build_query(array_merge($_GET, array("page" => $page - 1)));
                if ($page > 1) {
                    echo "<li class='page-item'>
                    <a class='page-link' href='?" . $qs . "' aria-label='Previous'>
                        <span aria-hidden='true'>&laquo; Previous</span>
                    </a>
                </li>";
                }
                $qs = http_build_query(array_merge($_GET, array("page" => $page + 1)));
                if ($page < $last_page) {
                    echo "<li class='page-item'>
                    <a class='page-link' href='?" . $qs . "' aria-label='Next'>
                        <span aria-hidden='true'>Next &raquo;</span>
                    </a>
                </li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>