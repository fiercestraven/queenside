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

    <!-- content -->
    <div class="container my-outpost-container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="outpost.php">
                    <img src="img/queenmeLogo.png" alt="an icon of a pawn with the words The Outpost and a crown" id="outpost-logo">
                </a>
            </div>
            <div class="col-md-9">
                <h1>Queen Me!</h1>
                <h5>If you were a chess queen, who would you be?</h5>
                <p>We've combed the data for the best of the best... simply select your home country and enter your year of birth to see the chess queen who most closely matches your details.</p>
            </div>
        </div>

        <form action="yourqueen.php" method="GET">
            <!-- Federation -->
            <div class="row mt-2">
                <label for="country" class="col-sm-2 col-form-label">Your home country:</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Dropdown selection for home country" name="usercountry" id="country">
                        <option value="country" selected>Select</option>
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
                <label for="birth_year" class="col-sm-2 col-form-label">Enter your birth year:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="e.g., 1987" name="userbirth" id="birth_year">
                </div>
            </div>

            <!-- submission button -->
            <div class="row mb-3">
                <button type="submit" class="btn btn-secondary" id="submit" disabled>Submit</button>
            </div>
        </form>

    </div>

    <script>
        var ucountry = document.getElementById("country");
        var ubirth = document.getElementById("birth_year");

        //don't allow user to submit unless they've filled out both bits
        // FIXME birth year isn't working - what to put for value?
        if (ucountry.value == "Select" || ubirth.value == "") {
            // FIXME switch false below back to true once value for birth year is fixed
                submit.disabled = false;
            } else {
                submit.disabled = false;
            }
    </script>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>