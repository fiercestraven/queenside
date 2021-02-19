<!DOCTYPE html>
<html lang="en">

<head>
    <?php
       include("../_partials/head.html");
       session_start();

    if (!isset($_SESSION['admin_40275431'])) {
        echo "Invalid login";
        header("Location: login.php");
    }
    include('../db.php');
    ?>
</head>

<body>
    <!-- logo and nav -->
    <?php
        include("../_partials/adminnav.html");
    ?>

    <!-- player edit form -->
    <div class="container" id="player-edit-container">
        <form>
            <h2 class="admin-intro">Admin: Player Edit</h2>
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
                    <input type="text" class="form-control" placeholder="5008123" id="inputFIDE">
                </div>
            </div>

            <!-- Player name -->
            <div class="row mb-3">
                <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Koneru, Humpy" id="inputPlayerName">
                </div>
            </div>

            <!-- Federation -->
            <div class="row mb-3">
                <label for="inputFederation" class="col-sm-2 col-form-label">Federation</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="India" id="inputFederation">
                </div>
            </div>

            <!-- Birth Year -->
            <div class="row mb-3">
                <label for="inputBirthYear" class="col-sm-2 col-form-label">Birth Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="1987" id="inputBirthYear">
                </div>
            </div>

            <!-- Player title -->
            <div class="row mb-3">
                <label for="inputPlayerTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Dropdown selection for player title">
                        <option selected>Select</option>
                        <option value="GM">Grandmaster</option>
                        <option value="WGM">Woman Grandmaster</option>
                        <option value="IM">International Master</option>
                        <option value="CM">Candidate Master</option>
                        <option value="FM">FIDE Master</option>
                        <option value="H">Honorary Grandmaster</option>
                        <option value="WIM">Woman International Master</option>
                        <option value="WCM">Woman Candidate Master</option>
                        <option value="WFM">Woman FIDE Master</option>
                        <option value="WH">Woman Honorary Grandmaster</option>
                    </select>
                </div>
            </div>

            <!-- Player ratings -->
            <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <label for="ratingstandard">Standard Rating</label>
                    <input type="text" class="form-control" placeholder="2586" aria-label="Standard rating"
                    name="ratingstandard">
                </div>
                <div class="col-sm-3">
                    <label for="ratingrapid">Rapid Rating</label>
                    <input type="text" class="form-control" placeholder="2483" aria-label="Rapid rating"
                    name="ratingrapid">
                </div>
                <div class="col-sm-3">
                    <label for="ratingblitz">Blitz Rating</label>
                    <input type="text" class="form-control" placeholder="2483" aria-label="Blitz rating"
                    name="ratingblitz">
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
        <!-- may need to change link below if players moves to admin side -->
        <a href="admin.php" class="my-light-link">&laquo; Return to player list</a>
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