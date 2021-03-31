<?php
include("../db.php");
include("../utils/functions.php");

//postback
if (isset($_POST['submit'])) {
    $usercountry = $conn->real_escape_string($_POST['usercountry']);
    $userbirth = $conn->real_escape_string($_POST['userbirth']);

    $sql = "SELECT *
        FROM top_women_chess_players 
        LEFT JOIN twcp_federations USING (federation)
        LEFT JOIN twcp_titles USING (title)
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
            $message = "You are your own unique queen! No chess stars were found within three years of your birth year. Here's an inspiring chess queen from your country.";
        }
    } else {
        $message = "You will have to be your own chess star, as your search has returned no close matches. Practice up!";
    }
}
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

    <!-- content -->
    <div class="container my-outpost-container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="outpost.php">
                    <img src="img/queenmeLogo.png" alt="an icon of a pawn with the words The Outpost and a crown" id="outpost-logo">
                </a>
            </div>
            <div class="col-md-9">
                <?php if (isset($_POST['submit'])) { ?>
                    <h1>You're a queen!</h1>
                    <p><?= $message ?></p>
                <?php } else { ?>
                    <h1>Queen Me!</h1>
                    <h5>If you were a chess queen, who would you be?</h5>
                    <p>We've combed the data for the best of the best... simply select your home country and enter your year of birth to see the chess queen who most closely matches your details.</p>
                <?php } ?>
            </div>
        </div>

        <?php if (isset($_POST['submit'])) {
            if (isset($queen)) { 
                // player card
                echo create_player_card($queen);
            } 
        } else { ?>
            <form action="" method="POST">
                <!-- Federation -->
                <div class="row mt-2">
                    <label for="country" class="col-sm-2 col-form-label">Your home country:</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Dropdown selection for home country" name="usercountry" id="country">
                            <option value="country" selected>Select Country</option>
                            <?php
                            //not escaping as this table is not edited by other users
                            $sqlfed = "SELECT * FROM twcp_federations ORDER BY country_name ASC";

                            $result = $conn->query($sqlfed);
                            if ($result) {
                                while ($fed = $result->fetch_assoc()) {
                                    echo "<option value='{$fed['federation']}'>{$fed['country_name']}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Birth Year -->
                <div class="row mb-3">
                    <label for="birth_year" class="col-sm-2 col-form-label">Year of Birth:</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Dropdown selection for birth year" name="userbirth" id="birth_year">
                            <option value="birth" selected>Select Year</option>
                            <!-- loop to show birth years from this year back 100 years -->
                            <?php
                            for ($i = (date("Y") - 100); $i <= date("Y"); $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- submission button -->
                <div class="row mb-3">
                    <button type="submit" class="btn btn-secondary" name="submit" id="submit" disabled>Submit</button>
                </div>
            </form>
        <?php }  ?>

        <!-- link to try again -->
        <div class="row mt-3">
            <a href="queenme.php" class="my-light-link">&laquo; Want to try again?</a>
        </div>

        <!-- link to go back to the Outpost -->
        <div class="row mt-3 mb-5">
            <a href="outpost.php" class="my-light-link">&laquo; Back to the Outpost</a>
        </div>

    </div>

    <script>
        var ucountry = document.getElementById("country");
        var ubirth = document.getElementById("birth_year");
        var submit = document.getElementById("submit");

        function queenFunction() {
            //don't allow user to submit unless they've filled out both bits    
            if (ucountry.value == "country" || ubirth.value == "birth") {
                submit.disabled = true;
            } else {
                submit.disabled = false;
            }
        }
        ucountry.oninput = queenFunction;
        ubirth.oninput = queenFunction;
    </script>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>