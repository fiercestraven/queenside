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

    <!-- calculate and display result of match-up -->
    <div class="container my-container my-outpost-container">
        <div class="row">
            <div class="col-md-3 mt-4">
                <a href="outpost.php">
                    <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
                </a>
            </div>

            <?php

            if (!isset($_GET["country1"]) || !isset($_GET["country2"])) {
                //if no id set, re-route to country showdown page
                header("Location: countryshowdown.php");
                die();
            }
            // calculate result of match-up
            $ctry1 = $conn->real_escape_string($_GET['country1']);
            $ctry2 = $conn->real_escape_string($_GET['country2']);

            $sql = "SELECT federation, 
            round(avg(rating_standard)) AS score,
            country_name
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            WHERE federation IN ('" . $ctry1 . "', '" . $ctry2 . "') 
            GROUP BY federation
            ORDER BY score DESC";

            $result = $conn->query($sql);
            if (!$result) {
                http_response_code(404);
            } else {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $first = $data[0];
                $second = $data[1];
                if ($first['score'] == $second['score']) {
                    $winner = $first['country_name'] . " and " . $second['country_name'] . " had a tie!";
                } else {
                    $winner = $first['country_name'] . "!";
                }
            }
            ?>

            <div class="col-md-9">
                <div class="mt-3">
                    <h1>And the winner is...</h1>
                </div>
                <div class="mt-2">
                    <p style="font-size: 30px; font-style: italic;"><?= $winner ?></p>
                </div>
                <div class="mt-5">
                    <table class="table my-country-results">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Average Standard Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active">
                                <td><?= $first['country_name'] ?></td>
                                <td><?= $first['score'] ?></td>
                            </tr>
                            <tr>
                                <td><?= $second['country_name'] ?></td>
                                <td><?= $second['score'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- link to go back to Country Showdown -->
        <div class="row mt-3 mb-5">
            <a href="countryshowdown.php" class="my-light-link">&laquo; Pick two more countries</a>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>