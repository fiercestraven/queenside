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

    <div class="container my-container my-outpost-container">
        <div class="row">
            <div class="col-md-3">
                <a href="outpost.php">
                    <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
                </a>
            </div>

            <?php

            if (!isset($_GET['usercountry']) || !isset($_GET['userbirth'])) {
                //if no info sent, re-route to queen me page
                header("Location: queenme.php");
                die();
            }
            // calculate results
            $usercountry = $conn->real_escape_string($_GET['usercountry']);
            $userbirth = $conn->real_escape_string($_GET['userbirth']);

            $sql = "SELECT *
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            WHERE federation = '$usercountry'
            AND birth_year IS NOT NULL
            ORDER BY abs(CAST(birth_year as int) - $userbirth)";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $queen = $result->fetch_assoc();
                $birthdiff = abs($queen['birth_year'] - $userbirth);

                if ($birthdiff == 0) {
                    $message = "You were born in the great year of $userbirth, and so was this chess star! Aren't you lucky to have such an illustrious match?";
                } else if ($birthdiff > 0 && $birthdiff >= 3) {
                    $message = "There are no exact matches for chess stars in your country who were born in your same birth year. Here's your closest match!";
                } else {
                    $message = "YOU are your own unique queen! No chess stars were found within three years of your birth year. Here's an inspiring chess queen from your country.";
                }
            } else {
                $message = "You will have to be your own chess star, as your search has returned no close matches. Practice up!";
            }
            ?>

            <div class="col-md-9">
                <h1>You're a queen!</h1>
                <p><?=$message?></p>
            </div>
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