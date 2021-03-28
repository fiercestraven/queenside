<?php
include("../utils/functions.php");
checksessionuser();


if (isset($_GET['id']) && $_GET['id']) {
    $mode = 'edit';
    $endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/player.php';
    $arr = ['id' => $_GET['id']];
    $qs = http_build_query($arr);

    $options = [
        'http' => ['ignore_errors' => true]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents("$endpoint?$qs", false, $context);

    $player = json_decode($result, true);
    if (isset($player['error'])) {
        $mode = 'create';
    } 
} else {
    $mode = 'create';
}

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
    include("../_partials/adminnav.html");
    ?>

    <!-- local player vars -->
    <?php
    if ($mode == 'edit') {
        $name = htmlspecialchars($player['name']);
        $inactive = $player['inactive'];
        $fed = htmlspecialchars($player['country_name']);
        $birth = $player['birth_year'] ?? 'Unknown';
        $title = htmlspecialchars($player['full_title']) ?? '';
        $ratingstd = $player['rating_standard'] ?? '';
        $ratingrap = $player['rating_rapid'] ?? '';
        $ratingblitz = $player['rating_blitz'] ?? '';
        $fide = $player['fide_id'];
    }
    ?>

    <!-- buttons for player deletion and logout -->
    <div class="container" id="player-edit-container">
        <?php
        if ($mode == 'create') { ?>
            <div class="row mb-4">
                <div class="col-sm-7"></div>
                <div class="col-sm-3">
                    <?php
                    echo "<p id='my-login-confirmation'>Logged in as {$_SESSION['admin_40275431']}</p>";
                    ?>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-secondary my-logout-button" role="button" href="../admin/logout.php">Log Out</a>
                </div>
            </div>

            <h2 class="mt-2 mb-3">Admin: Create New Player</h2>

    <?php } else { ?>
        <!-- delete button -->
        <div class="row mb-4">
            <div class="col-sm-3">
                <button type="button" onclick="document.getElementById('deletebtn').style.display='block'" class="btn btn-danger">DELETE PLAYER</button>
            </div>

            <div class="col-sm-4"></div>
            <div class="col-sm-3">
                <?php
                    echo "<p id='my-login-confirmation'>Logged in as {$_SESSION['admin_40275431']}</p>";
                ?>
            </div>

            <div class="col-sm-2">
                <a class="btn btn-secondary my-logout-button" role="button" href="../admin/logout.php">Log Out</a>
            </div>
        </div>

    <!-- https://www.w3schools.com/howto/howto_css_delete_modal.asp -->

    <div id="deletebtn" class="modal">

        <form class="modal-content my-modal-delete-content animate" action="deleteplayer.php" method="POST">
            <div class="container my-container">
                <h2>Delete Player</h2>
                <p>Are you sure you want to delete this player?</p>

                <!-- hidden field to hold player id -->
                <input type="hidden" name="playerid" value="<?= $_GET['id'] ?>">

                <div>
                    <button type="button" onclick="document.getElementById('deletebtn').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" class="my-delete-btn">Delete</button>
                </div>
            </div>
        </form>
    </div>

    <!-- player edit form -->
    <h2 class="mt-2 mb-3">Admin: Player Edit</h2>
<?php } ?>

    <form action="playerprocess.php" method="POST">
        <!-- send mode -->
        <input type="hidden" name="mode" value=<?=$mode?>>

<!-- Player image/icon FIXME -->
        <!-- <div class="row mb-3">
                <label for="form_image" class="col-sm-2 col-form-label">Profile Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="playerimage" id="form_image">
                </div>
            </div> -->

<!-- FIDE ID -->
<div class="row mb-3">
    <label for="FIDE" class="col-sm-2 col-form-label">FIDE ID</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="fide" placeholder="e.g., 12345" <?php if ($mode == 'edit') {echo "value = '$fide' readonly";} ?> id="FIDE" required>
    </div>
</div>

<!-- Player name -->
<div class="row mb-3">
    <label for="inputPlayerName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="playername" placeholder="Last, First" <?php if ($mode == 'edit') {echo "value='$name'";} ?> id="inputPlayerName" required>
    </div>
</div>

<!-- Federation -->
<div class="row mb-3">
    <div class='row hidden' id='my-fed-feedback' style='color: red;'>  
        <h5>Federation is required</h5>
    </div>
    <label for="fed" class="col-sm-2 col-form-label">Federation</label>
    <div class="col-sm-10">
        <select class="form-select" aria-label="Dropdown selection for player federation" name="country" id="fed">
            <option selected>Select</option>
            <?php
            //not escaping as this table is not edited by other users
            $sqlfed = "SELECT * FROM twcp_federations ORDER BY country_name ASC";

            $result = $conn->query($sqlfed);
            if ($result) {
                while ($fed = $result->fetch_assoc()) {
                    $selected = $fed['country_name'] == $player['country_name'] ? 'selected' : '';
                    echo "<option $selected value='{$fed['federation']}'>{$fed['country_name']}</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

<!-- Birth Year -->
<div class="row mb-3">
    <label for="birth" class="col-sm-2 col-form-label">Birth Year</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="birthyear" placeholder="4-digit Year" <?php if ($mode == 'edit') echo "value='$birth'"; ?> id="birth">
    </div>
</div>

<!-- Player title -->
<div class="row mb-3">
    <div class='row hidden' id='my-title-feedback' style='color: red;';>  
        <h5>Title is required</h5>
    </div>
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
        <select class="form-select" aria-label="Dropdown selection for player title" name="title" id="title">
            <option selected>Select</option>
            <?php
            //not escaping as this table is not edited by other users
            $sqltitle = "SELECT * FROM twcp_titles";

            $result = $conn->query($sqltitle);
            if ($result) {
                while ($title = $result->fetch_assoc()) {
                    $selected = $title['full_title'] == $player['full_title'] ? 'selected' : '';
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
        <input type="text" class="form-control" placeholder="0000" <?php if ($mode == 'edit') echo "value='$ratingstd'"; ?> aria-label="Standard rating" name="ratingstandard">
    </div>
    <div class="col-sm-3">
        <label for="ratingrapid">Rapid Rating</label>
        <input type="text" class="form-control" placeholder="0000" <?php if ($mode == 'edit') echo "value='$ratingrap'"; ?> aria-label="Rapid rating" name="ratingrapid">
    </div>
    <div class="col-sm-3">
        <label for="ratingblitz">Blitz Rating</label>
        <input type="text" class="form-control" placeholder="0000" <?php if ($mode == 'edit') echo "value='$ratingblitz'"; ?> aria-label="Blitz rating" name="ratingblitz">
    </div>
</div>

<!-- Player status -->
<fieldset class="row mb-3">
    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="radio_active" value="active" 
            <?php 
            if ($mode == 'edit') {
                if (!$inactive) {echo "checked";
                }
            }
            ?>>
            <label class="form-check-label" for="radio_active">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="radio_withdrawn" value="withdrawn" 
            <?php 
            if ($mode == 'edit') {
                if ($inactive) {
                    echo "checked";
                }
            }
            ?>>
            <label class="form-check-label" for="radio_withdrawn">
                Withdrawn
            </label>
        </div>
    </div>
</fieldset>

<!-- Form submission -->
<button type="submit" class="btn btn-secondary" id="submit" disabled>Submit</button>
</form>
</div>

<!-- link to return to player listing -->
<div class="container my-card-return">
    <a href="admin.php" class="my-light-link">&laquo; Return to players</a>
</div>

<script>
    var selectfed = document.getElementById("fed");
    var selecttitle = document.getElementById("title");
    var fedfeedback = document.getElementById("my-fed-feedback");
    var titlefeedback = document.getElementById("my-title-feedback");
    var submit = document.getElementById("submit");

    function selectFunction() {
        if (selectfed.value == 'Select') {
            fedfeedback.classList.remove('hidden');
        } else {
            fedfeedback.classList.add('hidden');
        }

        if (selecttitle.value == 'Select') {
            titlefeedback.classList.remove('hidden');
        } else {
            titlefeedback.classList.add('hidden');
        }

        //don't allow user to submit unless federation and title have been selected
        if (selectfed.value == "Select" || selecttitle.value == "Select") {
            submit.disabled = true;
        } else {
            submit.disabled = false;
        }

    }

    if(selectfed && selecttitle) {
        selectfed.oninput = selectFunction;
        selecttitle.oninput = selectFunction;
        selectFunction();
    }
</script>

<!-- Footer -->
<?php
include("../_partials/footer.html");
?>

<script>
        // Get the modal
        var modal = document.getElementById('deletebtn');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

<!-- JS Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>