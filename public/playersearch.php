<?php

include('../db.php');

// FIXME if only one result, redirect to playerdetail card

if (isset($_GET['playersearch']) && $_GET['playersearch']) {
    $idquery = (int)($_GET['playersearch']);
    $namequery = $_GET['playersearch'];
    $clauses[] = "fide_id = $idquery";
    $clauses[] = "name LIKE '%$namequery%' ";

    $newclause = '';

    //build up WHERE clauses
    if (count($clauses) > 0) {
        $newclause = 'WHERE ' . join(' OR ', $clauses);
    }

    //get count of how many players for pagination and redirect for one result
    $sqlcount = "SELECT COUNT(*) 
            FROM top_women_chess_players
            $newclause";
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

    // sql statement including LIMIT and OFFSET for page population
    $sql = "SELECT * 
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title) 
            $newclause
            LIMIT $per_page
            OFFSET $offset";

    $result = $conn->query($sql);

} else {
    //handle variables if no query provided
    $count = 0;
    $result = false;
    $page = 1;
    $last_page = 1;
}

if ($count == 1) {
    $player = $result->fetch_assoc();
    $fideid = $player['fide_id'];
    header("Location: playerdetail.php?id={$fideid}");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../db.php");
    include("../_partials/head.html");
    ?>
</head>

<body>
    <!-- logo and nav -->
    <?php
    include("../_partials/nav.html");
    ?>

    <!-- player table-->
    <div class="container my-container">
        <h3>Search Results</h3>
        <?php
        if ($count > 0) {
            echo "<p>$count results found</p>";
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">FIDE ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Federation (Country)</th>
                    <th scope="col">Birth Year</th>
                    <th scope="col">Chess Title</th>
                    <th scope="col">Standard Rating</th>
                    <th scope="col">Rapid Rating</th>
                    <th scope="col">Blitz Rating</th>
                    <th scope="col">Active</th>
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

                        $name = htmlspecialchars($player['name']);
                        $inactive = $player['inactive'];
                        $fed = htmlspecialchars($player['country_name']);
                        $birth = $player['birth_year'] ?? 'Unknown';
                        $title = htmlspecialchars($player['full_title']) ?? '';
                        $ratingstd = $player['rating_standard'] ?? '--';
                        $ratingrap = $player['rating_rapid'] ?? '--';
                        $ratingblitz = $player['rating_blitz'] ?? '--';
                        $fide = $player['fide_id'];

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
                        <span aria-hidden='true'>&laquo;</span>
                    </a>
                </li>";
                }
                // <li class="page-item active"><a class="page-link" href="#">1</a></li>
                // <li class="page-item"><a class="page-link" href="#">2</a></li>
                // <li class="page-item"><a class="page-link" href="#">3</a></li> 

                $qs = http_build_query(array_merge($_GET, array("page" => $page + 1)));
                if ($page < $last_page) {
                    echo "<li class='page-item'>
                    <a class='page-link' href='?" . $qs . "' aria-label='Next'>
                        <span aria-hidden='true'>&raquo;</span>
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