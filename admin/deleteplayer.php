<?php
include('../secrets.php');
include('../utils/functions.php');
checksessionuser();

$playerid = (int)$_POST['playerid'];

$options = [
    'http' => [
        'method' => 'DELETE',
        'header' => [
            'Content-Type: application/x-www-form-urlencoded',
            'API-Key: ' . $SECRETS['twcpapikey'],
        ],
        'ignore_errors' => true
    ]
];

$context = stream_context_create($options);

$endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/player.php';

$result = file_get_contents("$endpoint?id=$playerid", false, $context);
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
    <div class='m5 container my-container my-thanks'>
        <h2 class='my-response'><?= $result ?></h2>
    </div>

    <!-- link to return to player listing -->
    <div class="container my-card-return">
        <a href="admin.php" class="my-light-link">&laquo; Return to players</a>
    </div>

    <!-- Footer -->
    <?php
    include("../_partials/footer.html");
    ?>

    <!-- JS Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>