 <!-- FIXME saving for edit Page            
 <div class="col-sm-10" style="padding: 7px 12px;">
                    <?= $fide ?> -->

<?php

include('../db.php');

//create local variables-- no real_escape_string needed due to prepare/bind steps below
$fideid = $_POST['fide'];
$playername = $_POST['playername'];
$federation = $_POST['country'];
$birthyear = $_POST['birthyear'] ?? NULL;
$title = $_POST['title'] ?? NULL;
$ratingstd = $_POST['ratingstandard'] ?? NULL;
$ratingrap = $_POST['ratingrapid'] ?? NULL;
$ratingblitz = $_POST['ratingblitz'] ?? NULL;
//set boolean to true/false depending on status
if($_POST['status'] == 'withdrawn') {
    $inactive = 1;
} else {
    $inactive = 0;
}

$stmt = $conn->prepare("UPDATE top_women_chess_players SET name = ?, federation = ?, birth_year = ?, title = ?, rating_standard = ?, rating_rapid = ?, rating_blitz = ?, inactive = ? WHERE fide_id = ?");

$stmt->bind_param("ssisiiiii", $playername, $federation, $birthyear, $title, $ratingstd, $ratingrap, $ratingblitz, $inactive, $fideid);

$stmt->execute();
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

    <!-- return message after form submission -->
    <?php
    if ($stmt->error) {
        echo $stmt->error;
        die();
    } else if ($stmt->affected_rows == 0) {
        echo "No such player found";
    } else {
        echo "<div class='m5 container my-container my-thanks'>
                    <h1 class='my-response'>Player update submitted</h1>
                </div>";
    }
    ?>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>