<?php
    include("../utils/functions.php");

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
        include("../_partials/nav.php");
   ?>

    <!-- player card -->
    <?php
        if(isset($player['fide_id'])) {
            echo create_player_card($player);
        } else {
            echo "<div class='container my-container'>
                <h2 class='my-5'>Player not found!</h2>
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