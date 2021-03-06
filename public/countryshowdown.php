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

    <!-- content intro -->
    <div class="container my-container">
        <div class="row mt-5 mb-2">
            <div class="col-md-3">
                <a href="outpost.php">
                    <img src="img/outpostLogo.png" alt="an icon of a pawn with the words The Outpost" id="outpost-logo">
                </a>
            </div>
            <div class="col-md-9">
                <h2>Country vs Country</h2>
                <p>Pick two, any two!</p>
                <p>How does one country stack up against another? Find out in the country vs country showdown. Select any two countries to put their best women chess players head to head, and see whose average standard score comes out on top.
            </div>
        </div>

        <div class="row hidden" id="my-country-feedback">
            <h5>Please select two different countries to compare!</h5>
        </div>

        <!-- Country dropdowns -->
        <div class="row mb-3">
            <form id="my-country-form" action="countryresult.php" method="GET">
                <div class="col-sm-6 me-2">
                    <select class="form-select" aria-label="Dropdown for first country selection" name="country1" id="country-select1">
                        <option value="country1" selected>Country 1</option>
                        <?php
                        //not escaping as this table is not edited by other users
                        $sqlfed = "SELECT DISTINCT federation, country_name
                        FROM top_women_chess_players
                        LEFT JOIN twcp_federations USING (federation)
                        ORDER BY country_name ASC";

                        $result = $conn->query($sqlfed);
                        if ($result) {
                            $arr = $result->fetch_all(MYSQLI_ASSOC);
                            foreach ($arr as $row) {
                                echo "<option value='{$row['federation']}'>{$row['country_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Dropdown for second country selection" name="country2" id="country-select2">
                        <option value="country2" selected>Country 2</option>
                        <?php
                        foreach ($arr as $row) {
                            echo "<option value='{$row['federation']}'>{$row['country_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
        </div>
        <!-- submit button -->
        <div class="row">
            <button type="submit" class="btn btn-secondary" id="submit" disabled>Submit</button>
        </div>
        </form>
    </div>

    <script>
        var select1 = document.getElementById("country-select1");
        var select2 = document.getElementById("country-select2");
        var feedback = document.getElementById("my-country-feedback");
        var submit = document.getElementById("submit");

        function countryFunction() {
            if (select1.value == select2.value) {
                feedback.classList.remove('hidden');
            } else {
                feedback.classList.add('hidden');
            }
            //as soon as either of the dropdowns change, mark the other invalid if it hasn't changed 
            if (select1.value == "country1") {
                select1.classList.add('is-invalid');
            } else {
                select1.classList.remove('is-invalid');
            }

            if (select2.value == "country2") {
                select2.classList.add('is-invalid');
            } else {
                select2.classList.remove('is-invalid');
            }

            //don't allow user to submit unless they've selected two different countries
            if (select1.value == "country1" || select2.value == "country2" || select1.value == select2.value) {
                submit.disabled = true;
            } else {
                submit.disabled = false;
            }

        }
        select1.oninput = countryFunction;
        select2.oninput = countryFunction;
    </script>

    </div>

    <!-- map image -->
    <div class="row">
        <img class="img-responsive" id="my-map-image" src="img/mapDenmark.jpg" alt="brightly coloured map detail of part of Denmark">;
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>