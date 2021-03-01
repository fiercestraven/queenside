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
                <p>How does one country stack up against another? Find out in the country vs country showdown. Select any two countries to put their best women chess players head to head, and see whose average score comes out on top.
            </div>
        </div>

        <!-- Country dropdowns -->
        <div class="row mb-3">
            <form method="POST" action="countryaction.php">
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Dropdown for first country selection" name="country1">
                        <option value="country1" selected>Country 1</option>
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
                <div class="col-sm-6">
                    <select class="form-select" aria-label="Dropdown for second country selection" name="country1">
                        <option value="country1" selected>Country 2</option>
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
            </form>
        </div>

        <div class="row">
            <button type="submit" class="btn btn-secondary">Submit</button>
        </div>

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