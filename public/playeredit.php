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

    <!-- player edit form -->
    <div class="container" id="player-edit-container">
        <form>
            <h2 id="admin-intro">Admin: Player Edit</h2>
            <!-- Player image/icon -->
            <div class="row mb-3">
                <label for="formFile" class="col-sm-2 col-form-label">Profile Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="formFile">
                </div>
            </div>

            <!-- FIDE ID -->
            <div class="row mb-3">
                <label for="inputFIDE" class="col-sm-2 col-form-label">FIDE ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="e.g., 5000123" id="inputFIDE">
                </div>
            </div>

            <!-- Player name -->
            <div class="row mb-3">
                <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Last, First" id="inputPlayerName">
                </div>
            </div>

            <!-- Federation -->
            <div class="row mb-3">
                <label for="inputFederation" class="col-sm-2 col-form-label">Federation</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Player's home country" id="inputFederation">
                </div>
            </div>

            <!-- Birth Year -->
            <div class="row mb-3">
                <label for="inputBirthYear" class="col-sm-2 col-form-label">Birth Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="e.g., 1987" id="inputBirthYear">
                </div>
            </div>

            <!-- Player title -->
            <div class="row mb-3">
                <label for="inputPlayerTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Dropdown selection for player title">
                        <option selected>Select</option>
                        <option value="1">Grandmaster</option>
                        <option value="2">Woman Grandmaster</option>
                        <option value="3">International Master</option>
                        <option value="4">International Arbiter</option>
                        <option value="5">FIDE Arbiter</option>
                    </select>
                </div>
            </div>

            <!-- Player ratings -->
            <div class="row mb-3">
                <label for="playerRatings" class="col-sm-2 col-form-label">Ratings</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Std Rating" aria-label="Standard rating">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Rapid Rating" aria-label="Rapid rating">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Blitz Rating" aria-label="Blitz rating">
                </div>
            </div>

            <!-- Player status -->
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="radioActive" value="active"
                            checked>
                        <label class="form-check-label" for="radioActive">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="radioWithdrawn"
                            value="withdrawn">
                        <label class="form-check-label" for="radioWithdrawn">
                            Withdrawn
                        </label>
                    </div>
                </div>
            </fieldset>

            <!-- Form submission -->
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

    <!-- link to return to player listing -->
    <div class="container my-card-return">
        <a href="players.html" class="my-light-link">&laquo; Return to player list</a>
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