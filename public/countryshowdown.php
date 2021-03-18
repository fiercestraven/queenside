<?php

include("../db.php");

// if (!isset($_GET["country1"]) || !isset($_GET["country2"])) {
//     //if no id set, re-route to country showdown page
//     header("Location: countryshowdown.php");
//     die();
// }

//postback
if (isset($_POST['submit'])) {
    $ctry1 = $conn->real_escape_string($_POST['country1']);
    $ctry2 = $conn->real_escape_string($_POST['country2']);

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
                <?php if (isset($_POST['submit'])) { ?>
                    <div class='mt-3'>
                        <h2>And the winner is...</h2>
                    </div>
                    <div class='mt-2'>
                        <p style='font-size: 30px; font-style: italic;'><?= $winner ?></p>
                    </div>
                    <div class='mt-5'>
                        <table class='table my-country-results'>
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Average Standard Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class='table-active'>
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
                <?php } else { ?>
                    <h2>Country vs Country</h2>
                    <p>Pick two, any two!</p>
                    <p>How does one country stack up against another? Find out in the country vs country showdown. Select any two countries to put their best women chess players head to head, and see whose average standard score comes out on top.</p>

                    <div class='row hidden' id='my-country-feedback' style='float: left;'>
                        <h5>Please select two different countries to compare!</h5>
                    </div>
                <?php } ?>
            </div>
        </div>  

    <?php if (isset($_POST['submit'])) { ?>
        <!-- link to go back to Country Showdown -->
        <div class='row mt-3 mb-5'>
            <a href='countryshowdown.php' class='my-light-link'>&laquo; Pick two more countries</a>
        </div>
    </div>
    <?php } else { ?>
        <!-- Country dropdowns -->
        <div class='row mb-3'>
            <form id='my-country-form' action='' method='POST'>
                <div class='col-sm-6 me-2'>
                    <select class='form-select' aria-label='Dropdown for first country selection' name='country1' id='country-select1'>
                        <option value='country1' selected>Country 1</option>

                        <!-- not escaping as this table is not edited by other users -->
                        <?php
                        $sqlfed = 'SELECT DISTINCT federation, country_name
                            FROM top_women_chess_players
                            LEFT JOIN twcp_federations USING (federation)
                            ORDER BY country_name ASC';

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
                <div class='col-sm-6'>
                    <select class='form-select' aria-label='Dropdown for second country selection' name='country2' id='country-select2'>
                        <option value='country2' selected>Country 2</option>
                        <?php
                        foreach ($arr as $row) {
                            echo "<option value='{$row['federation']}'>{$row['country_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- submit button -->
            <div class='row'>
                <button type='submit' class='btn btn-secondary' name='submit' id='submit' disabled>Submit</button>
            </div>
        </form>
    </div>

    <!-- map image -->
    <div class="row">
        <img class="img-responsive" id="my-map-image" src="img/mapDenmark.jpg" alt="brightly coloured map detail of part of Denmark">
    </div>

    <!-- link to go back to the Outpost -->
    <div class="mb-3 container">
        <a href="outpost.php" class="my-light-link">&laquo; Back to the Outpost</a>
    </div>
<?php } ?>

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

    if(select1 && select2) {
        select1.oninput = countryFunction;
        select2.oninput = countryFunction;
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