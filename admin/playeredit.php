<?php
    include('../db.php');

    include("../utils/functions.php");
    checksessionuser();

    if(!isset($_GET["id"])) {
        //if no id set, re-route to admin page
        header("Location: admin.php");
        die();
    }

    $id = $conn->real_escape_string($_GET['id']);

    //not escaping federations or titles tables as they not edited by other users
    $sql = "SELECT * 
            FROM top_women_chess_players 
            LEFT JOIN twcp_federations USING (federation)
            LEFT JOIN twcp_titles USING (title)
            WHERE fide_id=$id";
    $result = $conn->query($sql);

    if(!$result) {
        http_response_code(404);
    } else {
        $player = $result->fetch_assoc();
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
        include("../_partials/adminnav.html");
    ?>

    <!-- player edit form -->
    <?php
        if(isset($player)) {
            
            $name = htmlspecialchars($player['name']);
            $inactive = $player['inactive'];
            $fed = htmlspecialchars($player['country_name']);
            $birth = $player['birth_year'] ?? 'Unknown';
            $title = htmlspecialchars($player['full_title']) ?? '';
            $ratingstd = $player['rating_standard'] ?? '--';
            $ratingrap = $player['rating_rapid'] ?? '--';
            $ratingblitz = $player['rating_blitz'] ?? '--';
            $fide = $player['fide_id'];
        }
    ?>
    
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
                    <input type="text" class="form-control" value="<?=$fide?>" id="inputFIDE">
                </div>
            </div>

            <!-- Player name -->
            <div class="row mb-3">
                <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?=$name?>" id="inputPlayerName">
                </div>
            </div>

            <!-- Federation -->
            <div class="row mb-3">
                <label for="inputFederation" class="col-sm-2 col-form-label">Federation</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Dropdown selection for player federation">
                        <option selected>Select</option>
                        <?php
                            //not escaping as this table is not edited by other users
                            $sqlfed = "SELECT * FROM twcp_federations";

                            $result = $conn->query($sqlfed);
                            if($result) {
                                while ($fed = $result->fetch_assoc()) {
                                    $selected = $fed['federation'] == $player['federation'] ? 'selected' : '';
                                    echo "<option $selected value='{$fed['federation']}'>{$fed['country_name']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Birth Year -->
            <div class="row mb-3">
                <label for="inputBirthYear" class="col-sm-2 col-form-label">Birth Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?=$birth?>" id="inputBirthYear">
                </div>
            </div>

            <!-- Player title -->
            <div class="row mb-3">
                <label for="inputPlayerTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Dropdown selection for player title">
                        <option selected>Select</option>
                        <?php
                            //not escaping as this table is not edited by other users
                            $sqltitle = "SELECT * FROM twcp_titles";

                            $result = $conn->query($sqltitle);
                            if($result) {
                                while ($title = $result->fetch_assoc()) {
                                    $selected = $title['title'] == $player['title'] ? 'selected' : '';
                                    echo "<option $selected value='{$title['title']}'>{$title['full_title']}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Player ratings -->
            <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <label for="ratingstandard">Standard Rating</label>
                    <input type="text" class="form-control" value="<?=$ratingstd?>" aria-label="Standard rating"
                    name="ratingstandard">
                </div>
                <div class="col-sm-3">
                    <label for="ratingrapid">Rapid Rating</label>
                    <input type="text" class="form-control" value="<?=$ratingrap?>" aria-label="Rapid rating"
                    name="ratingrapid">
                </div>
                <div class="col-sm-3">
                    <label for="ratingblitz">Blitz Rating</label>
                    <input type="text" class="form-control" value="<?=$ratingblitz?>" aria-label="Blitz rating"
                    name="ratingblitz">
                </div>
            </div>

            <!-- Player status -->
            <fieldset class="row mb-3">                
                <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="radioActive" value="active"
                        <?php
                            if(!$inactive) {
                                echo "checked";
                            }
                        ?>>
                        <label class="form-check-label" for="radioActive">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="radioWithdrawn"
                            value="withdrawn"
                            <?php
                            if($inactive) {
                                echo "checked";
                            }
                        ?>>
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