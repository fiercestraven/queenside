<?php
include("../db.php");
include("../utils/functions.php");

//set vars for queries
$featuredcountry = 'ENG';
$featuredcountryname = 'United Kingdom';

$upperage = 40;

//query to get top 3 active players
$sqltopactive = "SELECT fide_id, name, federation, birth_year, title, 
                    rating_standard, img_url,
                    country_name, full_title
                    FROM top_women_chess_players
                    LEFT JOIN twcp_federations USING (federation)
                    LEFT JOIN twcp_titles USING (title)
                    WHERE rating_standard IS NOT NULL AND inactive IS FALSE
                    ORDER BY rating_standard DESC
                    LIMIT 3";

//query to get top 3 country players
$sqltopcountry = "SELECT fide_id, name, federation, birth_year, title, 
                rating_standard, img_url,
                country_name, full_title
                FROM top_women_chess_players
                LEFT JOIN twcp_federations USING (federation)
                LEFT JOIN twcp_titles USING (title)
                WHERE rating_standard IS NOT NULL AND federation = '$featuredcountry'
                ORDER BY rating_standard DESC
                LIMIT 3";

//query to get top 3 active players over age limit
$sqltopage = "SELECT fide_id, name, federation, birth_year, title, 
                rating_standard, img_url,
                country_name, full_title
                FROM top_women_chess_players
                LEFT JOIN twcp_federations USING (federation)
                LEFT JOIN twcp_titles USING (title)
                WHERE rating_standard IS NOT NULL AND inactive IS FALSE AND (YEAR(now()) - birth_year) >= $upperage 
                ORDER BY rating_standard DESC
                LIMIT 3";

// query to pull num players with the 6 most common titles
$sqltitlenums = "SELECT title, full_title, count(*) as count
                FROM top_women_chess_players
                LEFT JOIN twcp_titles USING (title)
                WHERE title IS NOT NULL
                GROUP BY full_title
                ORDER BY count DESC
                LIMIT 6";

//query to pull top 15 countries by number of GM/WGM
$sqlcountrynums = "SELECT federation, title, country_name, full_title, count(*) as count
            FROM top_women_chess_players
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title)
            WHERE title IS NOT NULL AND title = 'GM' OR title = 'WGM'
            GROUP BY country_name
            ORDER BY count DESC
            LIMIT 15";

$resulttopactive = $conn->query($sqltopactive);
$resulttopcountry = $conn->query($sqltopcountry);
$resulttopage = $conn->query($sqltopage);
$resulttitlenums = $conn->query($sqltitlenums);
$resultcountrynums = $conn->query($sqlcountrynums);

if (!$resulttopactive || !$resulttopcountry || !$resulttopage || !$resulttitlenums || !$resultcountrynums) {
    // FIXME handle if less than 3 results rather than 404 error (put in empty array?)
    http_response_code(404);
} else {
    $dataactive = $resulttopactive->fetch_all(MYSQLI_ASSOC);
    $datacountry = $resulttopcountry->fetch_all(MYSQLI_ASSOC);
    $dataage = $resulttopage->fetch_all(MYSQLI_ASSOC);
    $datatitlenums = $resulttitlenums->fetch_all(MYSQLI_ASSOC);
    $datacountrynums = $resultcountrynums->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../_partials/head.html");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<body>
    <!-- logo and nav -->
    <?php
    include("../_partials/nav.php");
    ?>

    <!-- intro and first chart -->
    <div class="container my-container">
        <h1 class="mt-5">Discover the Best Women in Chess</h1>
        <p>Who determines who's best, you ask? It's not easy with this many strong contenders. Here, we look at who's tops in standard rating in a variety of categories. Click on a player to learn more.</p>

        <h3 class="mt-5">Which countries have the most Grandmasters?</h3>
        <canvas id="numCountriesChart"></canvas>

        <!-- set arrays for charts -->
        <?php
        $labelarrctry = array();
        $dataarrctry = array();
        $labelarrtitles = array();
        $dataarrtitles = array();

        if (isset($datacountrynums)) {
            foreach ($datacountrynums as $row) {
                $labelarrctry[] = $row['country_name'];
                $dataarrctry[] = $row['count'];
            }
        }

        if (isset($datatitlenums)) {
            foreach ($datatitlenums as $row) {
                $labelarrtitles[] = $row['full_title'];
                $dataarrtitles[] = $row['count'];
            }
        }

        //convert arrays to JSON
        $labelarrctry_json = json_encode($labelarrctry);
        $dataarrctry_json = json_encode($dataarrctry);
        $labelarrtitles_json = json_encode($labelarrtitles);
        $dataarrtitles_json = json_encode($dataarrtitles);
        ?>
    </div>

    <!-- player cards -->
    <div class="container my-container">
        <div class="row mt-5">
            <h3>Top 3 Active Players</h3>
        </div>
        <div class="row mb-1 row-cols-1 row-cols-md-3 g-4">
            <?php
            if (isset($dataactive)) {
                foreach ($dataactive as $player) {
                    echo create_discover_card($player);
                }
            }
            ?>
        </div>
        <div class="row col-md-12 mt-2 mb-5">
            <a class="my-light-link my-discover-link" href="players.php?statusswitch=status">Find more active players &raquo;</a>
        </div>

        <h3>Top 3 Players in the <?= $featuredcountryname ?></h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if (isset($datacountry)) {
                foreach ($datacountry as $player) {
                    echo create_discover_card($player);
                }
            }
            ?>
        </div>
        <div class="row col-md-12 mt-2 mb-5">
            <a class="my-light-link my-discover-link" href="players.php?playercountry=<?= $featuredcountry ?>">Find more players from the <?= $featuredcountryname ?> &raquo;</a>
        </div>

        <h3>Top 3 Active Players Over Age 40</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            if (isset($dataage)) {
                foreach ($dataage as $player) {
                    echo create_discover_card($player);
                }
            }
            ?>
        </div>
        <div class="row col-md-12 mt-2 mb-5">
            <a class="my-light-link my-discover-link" href="players.php">Search for more players by birth year, title, and more &raquo;</a>
        </div>
        
        <h3>What proportion of players hold the most common titles?</h3>
        <canvas id="numTitlesChart"></canvas>

        <script>
            //translate arrays into JS
            var labelarrctry = JSON.parse('<?= $labelarrctry_json; ?>');
            var dataarrctry = JSON.parse('<?= $dataarrctry_json; ?>');;
            var labelarrtitles = JSON.parse('<?= $labelarrtitles_json; ?>');
            var dataarrtitles = JSON.parse('<?= $dataarrtitles_json; ?>');;

            //set up bar chart of countries w/ most titled players
            var ctx = document.getElementById('numCountriesChart').getContext('2d');
            var numCountriesChart = new Chart(ctx, {
                type: 'bar',

                data: {
                    labels: labelarrctry,
                    datasets: [{
                        label: 'Number of Grandmasters/Woman Grandmasters',
                        backgroundColor: [
                            '#5C2B56',
                            '#823D79',
                            '#A84F9B',
                            '#CF61BC',
                            '#D98FCE',
                            '#5C2B56',
                            '#823D79',
                            '#A84F9B',
                            '#CF61BC',
                            '#D98FCE',
                            '#5C2B56',
                            '#823D79',
                            '#A84F9B',
                            '#CF61BC',
                            '#D98FCE'
                        ],
                        data: dataarrctry
                    }]
                },
            });

            // set up doughnut chart w/ frequency of titles
            var ctx = document.getElementById('numTitlesChart').getContext('2d');
            var numTitlesChart = new Chart(ctx, {
                type: 'doughnut',

                // bring in data
                data: {
                    labels: labelarrtitles,
                    datasets: [{
                        backgroundColor: [
                            '#5C2B56',
                            '#823D79',
                            '#A84F9B',
                            '#CF61BC',
                            '#D98FCE',
                            '#421E3C'
                        ],
                        data: dataarrtitles
                    }]
                },
            });
        </script>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>