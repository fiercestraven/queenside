<?php
    include ("../db.php");

    if(!isset($_GET["id"])) {
        //if no id set, re-route to home page
        header("Location: ./");
        die();
    }

    $endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/player.php';
    $qs = http_build_query($_GET);
    $options = [
        'http' => ['ignore_errors' => true]
    ];
    $context = stream_context_create($options);

    $result = file_get_contents("$endpoint?$qs", false, $context);

    $player = json_decode($result, true);

    //include db connection to retrieve full names for countries & titles
    include('../db.php');
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
        include("../_partials/nav.html");
   ?>

    <?php
        if(isset($player['fide_id'])) {
            $name = htmlspecialchars($player['name']);
            $inactive = $player['inactive'];
            $fed = htmlspecialchars($player['country_name']);
            $birth = $player['birth_year'] ?? 'Unknown';
            $title = htmlspecialchars($player['full_title']) ?? '';
            $ratingstd = $player['rating_standard'] ?? '--';
            $ratingrap = $player['rating_rapid'] ?? '--';
            $ratingblitz = $player['rating_blitz'] ?? '--';
            $fide = $player['fide_id'];
    ?>
    
    <!-- player info -->
    <div class="card mb-3 my-detail-card">
        <div class="row g-0">
            <div class="col-md-4">
                <img class="img-responsive my-profile-icon" src="img/Chess_qlt45.svg" alt="icon of a chess queen">
            </div>
            <div class="col-md-8">
                <!-- player name -->
                <div class="card-header my-card-header"><?=$name?></div>
                <div class="card-body">
                    <!-- other player info -->
                    <p class="card-text">Status: 
                        <?php
                        if($inactive) {
                            echo "<span class='my-player-inactive'>Withdrawn</span></p>";
                        } else {
                            echo "<span class='my-player-active'>Active</span></p>";
                        }
                        ?>
                    <p class="card-text">Federation: <?=$fed?></p>
                    <p class="card-text">Birth Year: <?=$birth?></p>
                    <p class="card-text">Title: <?=$title?></p>
                    <!-- rating stats -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm my-ratings">
                                Std Rating: <?=$ratingstd?>
                            </div>
                            <div class="col-sm my-ratings">
                                Rapid Rating: <?=$ratingrap?>
                            </div>
                            <div class="col-sm my-ratings">
                                Blitz Rating: <?=$ratingblitz?>
                            </div>
                        </div>
                    </div>
                    <!-- link to FIDE profile -->
                    <p class="card-text mt-2"><small class="text-muted">FIDE ID: <a
                                href="https://ratings.fide.com/profile/<?=$fide?>" class="my-light-link"
                                target="_blank"><?=$fide?></a></small></p>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        } else {
            echo "<div class='container my-container'>
                <h2>Player not found!</h2>
            </div>";
        }
    ?>

    <!-- link to go back to player list -->
    <div class="container my-card-return">
        <a href="../public/players.php" class="my-light-link">&laquo; Search players</a>
    </div>

    <!-- link to go to discover page -->
    <div class="container my-card-return">
        <a href="../public/discover.php" class="my-light-link">&laquo; Discover top players and more</a>
    </div>

    <!-- Footer -->
    <?php
        include("../_partials/footer.html");
    ?>  

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>

</html>