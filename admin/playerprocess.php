 <?php
    include('../secrets.php');

    //create local variables-- no real_escape_string needed due build query below
    $fideid = $_POST['fide'];
    $playername = $_POST['playername'];
    $federation = $_POST['country'];
    $birthyear = $_POST['birthyear'] ?? NULL;
    $title = $_POST['title'] ?? NULL;
    $ratingstd = $_POST['ratingstandard'] ?? NULL;
    $ratingrap = $_POST['ratingrapid'] ?? NULL;
    $ratingblitz = $_POST['ratingblitz'] ?? NULL;
    //set boolean to true/false depending on status
    if (isset($_POST['status'])) {
        if ($_POST['status'] == 'withdrawn') {
            $inactive = 1;
        } else {
            $inactive = 0;
        }
    } else {
        $inactive = 0;
    }

    if ((int)$ratingstd == 0) {$ratingstd = NULL;}
    if ((int)$ratingrap == 0) {$ratingrap = NULL;}
    if ((int)$ratingblitz == 0) {$ratingblitz = NULL;}

    $mode = $_POST['mode'];

    if ($mode == 'edit') {
        $method = 'PUT';
        $qs = "?id=$fideid";
        $endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/player.php';
    } else if ($mode == 'create') {
        $method = 'POST';
        $qs = '';
        $endpoint = 'http://fveit01.lampt.eeecs.qub.ac.uk/project/api/players.php';
    } else {
        http_response_code(401);
        echo "UNAUTHORIZED";
        die();
    }

    $data = http_build_query([
        'inputFIDE' => $fideid,
        'inputPlayerName' => $playername,
        'inputFederation' => $federation,
        'inputBirthYear' => $birthyear,
        'inputPlayerTitle' => $title,
        'ratingstandard' => $ratingstd,
        'ratingrapid' => $ratingrap,
        'ratingblitz' => $ratingblitz,
        'status' => $inactive
    ]);

    $options = [
        'http' => [
            'method' => $method,
            'header' => [
                'Content-Type: application/x-www-form-urlencoded',
                'API-Key: ' . $SECRETS['twcpapikey'],
            ],
            'content' => $data,
            'ignore_errors' => true
        ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents("$endpoint$qs", false, $context);
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
         <?php if($result == 'Player created') { ?>
            <!-- button to create another new player -->
            <div class="mt-4" style="float: left;">
                <a class="btn btn-info" style="float: right;" href='playeredit.php' role="button">Create Another Player</a>
            </div>
        <?php } ?>
     </div>

     <!-- link to return to player listing -->
     <div class="container my-card-return">
         <a href="playeredit.php?id=<?=$fideid?>" class="my-light-link">&laquo; Return to player profile</a>
     </div>

     <!-- Footer -->
     <?php
        include("../_partials/footer.html");
        ?>

     <!-- JS Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

 </body>

 </html>